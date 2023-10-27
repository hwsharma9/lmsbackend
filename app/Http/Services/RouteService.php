<?php

namespace App\Http\Services;

use App\Models\DatabaseRoute;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RouteService
{

    public function userAuthorisedToRoute($current_route, $permissions)
    {
        return in_array($current_route, $permissions);
    }

    public function getCurrentRoute($route = '')
    {
        if (empty($route)) {
            $current_route = Route::currentRouteName();
        } else {
            $current_route = $route;
        }
        return str_replace('manage.', '', $current_route);
    }

    public function getPermissionNameByRoute($named_route)
    {
        $route = DatabaseRoute::whereHas('permission')
            ->with(['permission'])
            ->where('named_route', $named_route)
            ->first();
        // dd($named_route, $route);
        return isset($route->permission) ? $route->permission->name : null;
    }

    public function getDefaultRole()
    {
        return session('role_name', Auth::user()->roles[0]->name);
    }

    public function getRoleByName($role_name = '')
    {
        if (empty($role_name)) {
            $role_name = $this->getDefaultRole();
        }
        if (!$role_name) {
            return null;
        }
        return Role::findByName($role_name);
    }

    public function getAllPermissionsNamedRoute()
    {
        $role = $this->getRoleByName();
        if (!$role) {
            return null;
        }
        $permissions = Permission::whereHas('databaseRoute')
            ->with(['databaseRoute'])
            ->whereIn('id', $role->permissions->pluck('id')->all())
            ->get();

        $named_routes = $permissions->pluck('databaseRoute.named_route')
            ->all();

        $named_routes[] = 'home';
        return $permissions->pluck('name')->all();
    }
}

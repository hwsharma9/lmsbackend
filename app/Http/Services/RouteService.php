<?php

namespace App\Http\Services;

use App\Models\DatabaseRoute;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RouteService
{
    // public function __construct()
    // {
    //     dd(session('db_route'));
    // }
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

    public function findPermissionByNamedRoute($named_route)
    {
        $db_route = session('db_route');
        $is_found = $db_route->where('named_route', $named_route);
        if ($is_found->count() > 0) {
            return $is_found->first();
        } else {
            info('named_route => ' . $named_route . ' found by query!');
            return null;
            // return DatabaseRoute::whereHas('permission')
            //     ->with(['permission'])
            //     ->where('named_route', $named_route)
            //     ->first();
        }
    }

    public function getPermissionNameByRoute($named_route)
    {
        $route = $this->findPermissionByNamedRoute($named_route);
        return isset($route->permission) ? $route->permission->name : null;
    }

    public function getDefaultRole()
    {
        return session('role_name', session('role_name'));
    }

    public function getRoleByName($role_name = '')
    {
        if (empty($role_name)) {
            $role_name = $this->getDefaultRole();
        }
        if (!$role_name) {
            return null;
        }
        return $this->findRoleByName($role_name);
    }

    public function findRoleByName($role_name)
    {
        $roles = session('user_roles');
        $is_role = $roles->where('name', $role_name);
        if ($is_role->count() > 0) {
            return $is_role->first();
        } else {
            info('role_name => ' . $role_name . ' find!');
            return Role::findByName($role_name);
        }
    }

    public function getAllPermissionsNamedRoute()
    {
        $role = $this->getRoleByName();
        if (!$role) {
            return null;
        }
        if ($role->permissions) {
            $permissions = $role->permissions;
        } else {
            info('run permissions query!');
            $permissions = Permission::whereHas('databaseRoute')
                ->with(['databaseRoute'])
                ->whereIn('id', $role->permissions->pluck('id')->all())
                ->get();
        }

        $named_routes = $permissions->pluck('databaseRoute.named_route')
            ->all();

        $named_routes[] = 'home';
        return $permissions->pluck('name')->all();
    }
}

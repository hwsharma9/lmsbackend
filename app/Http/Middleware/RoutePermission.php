<?php

namespace App\Http\Middleware;

use App\Models\DatabaseRoute;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoutePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route_service = new RouteService();
        $current_route = $route_service->getCurrentRoute();
        $permission_name = $route_service->getPermissionNameByRoute($route_service->getCurrentRoute());
        $permissions = $route_service->getAllPermissionsNamedRoute();
        // dd($permission_name, $permissions);
        // info('permission_name');
        // info($permission_name);
        // info('permissions');
        // info($permissions);
        if (!$current_route || !$permission_name || !$route_service->userAuthorisedToRoute(trim($permission_name), $permissions)) {
            return response(view('admin.errors.unauthorized'));
        }
        return $next($request);
    // }

    // public function userAuthorisedToRoute($current_route, $permissions)
    // {
    //     info('in_array');
    //     info(in_array($current_route, $permissions));
    //     return in_array($current_route, $permissions);
    // }


    // public function getCurrentRoute()
    // {
    //     $current_route = Route::currentRouteName();
    //     return str_replace('manage.', '', $current_route);
    // }

    // public function getPermissionNameByRoute($named_route)
    // {
    //     $route = DatabaseRoute::whereHas('permission')
    //         ->with(['permission'])
    //         ->where('named_route', $named_route)
    //         ->first();
    //     return isset($route->permission) ? $route->permission->name : null;
    // }

    // public function getDefaultRole()
    // {
    //     return session('role_name', Auth::user()->roles[0]->name);
    // }

    // public function getRoleByName($role_name = '')
    // {
    //     if (empty($role_name)) {
    //         $role_name = $this->getDefaultRole();
    //     }
    //     if (!$role_name) {
    //         return null;
    //     }
    //     return Role::findByName($role_name);
    // }

    // public function getAllPermissionsNamedRoute()
    // {
    //     $role = $this->getRoleByName();
    //     if (!$role) {
    //         return null;
    //     }
    //     $permissions = Permission::whereHas('databaseRoute')
    //         ->with(['databaseRoute'])
    //         ->whereIn('id', $role->permissions->pluck('id')->all())
    //         ->get();

    //     $named_routes = $permissions->pluck('databaseRoute.named_route')
    //         ->all();

    //     $named_routes[] = 'home';
    //     return $permissions->pluck('name')->all();
    // }
}

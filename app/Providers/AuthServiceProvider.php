<?php

namespace App\Providers;

use App\Http\Services\RouteService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('check-auth', function ($user, $route = '') {
            // info('provider => ' . $route);
            $route_service = new RouteService();
            $current_route = $route_service->getCurrentRoute($route);
            $permission_name = $route_service->getPermissionNameByRoute($current_route);
            $permissions = $route_service->getAllPermissionsNamedRoute();
            // dd($current_route, $permission_name, $permissions, $route_service->userAuthorisedToRoute(trim($permission_name), $permissions));
            if (!$current_route || !$permission_name || !$route_service->userAuthorisedToRoute(trim($permission_name), $permissions)) {
                return false;
            } else {
                return true;
            }
        });
    }
}

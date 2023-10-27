<?php

namespace Database\Seeders;

use App\Models\DatabaseRoute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('database_routes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $details = [
            [
                'id' => 1,
                'resides_at' => 'manage',
                'controller_name' => 'PermissionController',
                'route' => 'permissions',
                'named_route' => 'permissions.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 2,
                'resides_at' => 'manage',
                'controller_name' => 'PermissionController',
                'route' => 'permissions/create',
                'named_route' => 'permissions.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 3,
                'resides_at' => 'manage',
                'controller_name' => 'PermissionController',
                'route' => 'permissions',
                'named_route' => 'permissions.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 4,
                'resides_at' => 'manage',
                'controller_name' => 'PermissionController',
                'route' => 'permissions/{permission}/edit',
                'named_route' => 'permissions.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 5,
                'resides_at' => 'manage',
                'controller_name' => 'PermissionController',
                'route' => 'permissions/{permission}',
                'named_route' => 'permissions.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 6,
                'resides_at' => 'manage',
                'controller_name' => 'PermissionController',
                'route' => 'permissions/{permission}',
                'named_route' => 'permissions.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 7,
                'resides_at' => 'manage',
                'controller_name' => 'DatabaseRouteController',
                'route' => 'databaseroutes',
                'named_route' => 'databaseroutes.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 8,
                'resides_at' => 'manage',
                'controller_name' => 'DatabaseRouteController',
                'route' => 'databaseroutes/create',
                'named_route' => 'databaseroutes.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 9,
                'resides_at' => 'manage',
                'controller_name' => 'DatabaseRouteController',
                'route' => 'databaseroutes',
                'named_route' => 'databaseroutes.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 10,
                'resides_at' => 'manage',
                'controller_name' => 'DatabaseRouteController',
                'route' => 'databaseroutes/{databaseroute}/edit',
                'named_route' => 'databaseroutes.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 11,
                'resides_at' => 'manage',
                'controller_name' => 'DatabaseRouteController',
                'route' => 'databaseroutes/{databaseroute}',
                'named_route' => 'databaseroutes.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 12,
                'resides_at' => 'manage',
                'controller_name' => 'DatabaseRouteController',
                'route' => 'databaseroutes/{databaseroute}',
                'named_route' => 'databaseroutes.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 13,
                'resides_at' => 'manage',
                'controller_name' => 'AdminMenuController',
                'route' => 'menus/update-all',
                'named_route' => 'menus.update-all',
                'method' => 'patch',
                'function_name' => 'updateAll',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 14,
                'resides_at' => 'manage',
                'controller_name' => 'AdminMenuController',
                'route' => 'menus',
                'named_route' => 'menus.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 15,
                'resides_at' => 'manage',
                'controller_name' => 'AdminMenuController',
                'route' => 'menus/create',
                'named_route' => 'menus.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 16,
                'resides_at' => 'manage',
                'controller_name' => 'AdminMenuController',
                'route' => 'menus',
                'named_route' => 'menus.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 17,
                'resides_at' => 'manage',
                'controller_name' => 'AdminMenuController',
                'route' => 'menus/{menu}/edit',
                'named_route' => 'menus.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 18,
                'resides_at' => 'manage',
                'controller_name' => 'AdminMenuController',
                'route' => 'menus/{menu}',
                'named_route' => 'menus.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 19,
                'resides_at' => 'manage',
                'controller_name' => 'AdminMenuController',
                'route' => 'menus/{menu}',
                'named_route' => 'menus.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 20,
                'resides_at' => 'manage',
                'controller_name' => 'UserController',
                'route' => 'users',
                'named_route' => 'users.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 21,
                'resides_at' => 'manage',
                'controller_name' => 'UserController',
                'route' => 'users/create',
                'named_route' => 'users.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 22,
                'resides_at' => 'manage',
                'controller_name' => 'UserController',
                'route' => 'users',
                'named_route' => 'users.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 23,
                'resides_at' => 'manage',
                'controller_name' => 'UserController',
                'route' => 'users/{user}/edit',
                'named_route' => 'users.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 24,
                'resides_at' => 'manage',
                'controller_name' => 'UserController',
                'route' => 'users/{user}',
                'named_route' => 'users.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 25,
                'resides_at' => 'manage',
                'controller_name' => 'UserController',
                'route' => 'users/{user}',
                'named_route' => 'users.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 26,
                'resides_at' => 'manage',
                'controller_name' => 'PageController',
                'route' => 'pages',
                'named_route' => 'pages.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 27,
                'resides_at' => 'manage',
                'controller_name' => 'PageController',
                'route' => 'pages/create',
                'named_route' => 'pages.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 28,
                'resides_at' => 'manage',
                'controller_name' => 'PageController',
                'route' => 'pages',
                'named_route' => 'pages.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 29,
                'resides_at' => 'manage',
                'controller_name' => 'PageController',
                'route' => 'pages/{page}/edit',
                'named_route' => 'pages.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 30,
                'resides_at' => 'manage',
                'controller_name' => 'PageController',
                'route' => 'pages/{page}',
                'named_route' => 'pages.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 31,
                'resides_at' => 'manage',
                'controller_name' => 'PageController',
                'route' => 'pages/{page}',
                'named_route' => 'pages.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 32,
                'resides_at' => 'manage',
                'controller_name' => 'RoleController',
                'route' => 'roles',
                'named_route' => 'roles.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 33,
                'resides_at' => 'manage',
                'controller_name' => 'RoleController',
                'route' => 'roles/create',
                'named_route' => 'roles.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 34,
                'resides_at' => 'manage',
                'controller_name' => 'RoleController',
                'route' => 'roles',
                'named_route' => 'roles.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 35,
                'resides_at' => 'manage',
                'controller_name' => 'RoleController',
                'route' => 'roles/{role}/edit',
                'named_route' => 'roles.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 36,
                'resides_at' => 'manage',
                'controller_name' => 'RoleController',
                'route' => 'roles/{role}',
                'named_route' => 'roles.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 37,
                'resides_at' => 'manage',
                'controller_name' => 'RoleController',
                'route' => 'roles/{role}',
                'named_route' => 'roles.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 38,
                'resides_at' => 'manage',
                'controller_name' => 'FrontMenuModuleController',
                'route' => 'frontmenumodules',
                'named_route' => 'frontmenumodules.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 39,
                'resides_at' => 'manage',
                'controller_name' => 'FrontMenuModuleController',
                'route' => 'frontmenumodules/create',
                'named_route' => 'frontmenumodules.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 40,
                'resides_at' => 'manage',
                'controller_name' => 'FrontMenuModuleController',
                'route' => 'frontmenumodules',
                'named_route' => 'frontmenumodules.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 41,
                'resides_at' => 'manage',
                'controller_name' => 'FrontMenuModuleController',
                'route' => 'frontmenumodules/{frontmenumodule}/edit',
                'named_route' => 'frontmenumodules.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 42,
                'resides_at' => 'manage',
                'controller_name' => 'FrontMenuModuleController',
                'route' => 'frontmenumodules/{frontmenumodule}',
                'named_route' => 'frontmenumodules.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 43,
                'resides_at' => 'manage',
                'controller_name' => 'FrontMenuModuleController',
                'route' => 'frontmenumodules/{frontmenumodule}',
                'named_route' => 'frontmenumodules.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 44,
                'resides_at' => 'manage',
                'controller_name' => 'AdminController',
                'route' => 'admins',
                'named_route' => 'admins.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 45,
                'resides_at' => 'manage',
                'controller_name' => 'AdminController',
                'route' => 'admins/create',
                'named_route' => 'admins.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 46,
                'resides_at' => 'manage',
                'controller_name' => 'AdminController',
                'route' => 'admins',
                'named_route' => 'admins.store',
                'method' => 'post',
                'function_name' => 'store',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 47,
                'resides_at' => 'manage',
                'controller_name' => 'AdminController',
                'route' => 'admins/{admin}/edit',
                'named_route' => 'admins.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 48,
                'resides_at' => 'manage',
                'controller_name' => 'AdminController',
                'route' => 'admins/{admin}',
                'named_route' => 'admins.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 49,
                'resides_at' => 'manage',
                'controller_name' => 'AdminController',
                'route' => 'admins/{admin}',
                'named_route' => 'admins.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 50,
                'resides_at' => 'manage',
                'controller_name' => 'MediaController',
                'route' => 'medias',
                'named_route' => 'medias.index',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 51,
                'resides_at' => 'manage',
                'controller_name' => 'MediaController',
                'route' => 'medias/create',
                'named_route' => 'medias.create',
                'method' => 'get',
                'function_name' => 'create',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 52,
                'resides_at' => 'manage',
                'controller_name' => 'MediaController',
                'route' => 'medias/{media}/edit',
                'named_route' => 'medias.edit',
                'method' => 'get',
                'function_name' => 'edit',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 53,
                'resides_at' => 'manage',
                'controller_name' => 'MediaController',
                'route' => 'medias/{media}/update',
                'named_route' => 'medias.update',
                'method' => 'patch',
                'function_name' => 'update',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 54,
                'resides_at' => 'manage',
                'controller_name' => 'MediaController',
                'route' => 'medias/{media}',
                'named_route' => 'medias.destroy',
                'method' => 'delete',
                'function_name' => 'delete',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 55,
                'resides_at' => 'manage',
                'controller_name' => 'HomeController',
                'route' => 'home',
                'named_route' => 'home',
                'method' => 'get',
                'function_name' => 'index',
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
        ];
        DatabaseRoute::insert($details);
    }
}
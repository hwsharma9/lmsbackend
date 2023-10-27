<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Permission::insert([
            [
                'id' => 1,
                'name' => 'Show Admins List',
                'guard_name' => 'admin',
                'database_route_id' => 44,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 2,
                'name' => 'Show Create Admin Page',
                'guard_name' => 'admin',
                'database_route_id' => 45,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 3,
                'name' => 'Give Store Admin Page',
                'guard_name' => 'admin',
                'database_route_id' => 46,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 4,
                'name' => 'Show Edit Admin Page',
                'guard_name' => 'admin',
                'database_route_id' => 47,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 5,
                'name' => 'Give Update Admin Page',
                'guard_name' => 'admin',
                'database_route_id' => 48,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 6,
                'name' => 'Show Users List',
                'guard_name' => 'admin',
                'database_route_id' => 20,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 7,
                'name' => 'Show Create User Page',
                'guard_name' => 'admin',
                'database_route_id' => 21,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 8,
                'name' => 'Give Store User Page',
                'guard_name' => 'admin',
                'database_route_id' => 22,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 9,
                'name' => 'Show Edit User Page',
                'guard_name' => 'admin',
                'database_route_id' => 23,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 10,
                'name' => 'Give Update User Page',
                'guard_name' => 'admin',
                'database_route_id' => 24,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 11,
                'name' => 'Show Menus List',
                'guard_name' => 'admin',
                'database_route_id' => 14,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 12,
                'name' => 'Show Pages List',
                'guard_name' => 'admin',
                'database_route_id' => 26,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 13,
                'name' => 'Show Create Page Page',
                'guard_name' => 'admin',
                'database_route_id' => 27,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 14,
                'name' => 'Give Store Page Page',
                'guard_name' => 'admin',
                'database_route_id' => 28,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 15,
                'name' => 'Show Edit Page Page',
                'guard_name' => 'admin',
                'database_route_id' => 29,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 16,
                'name' => 'Give Update Page Page',
                'guard_name' => 'admin',
                'database_route_id' => 30,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 17,
                'name' => 'Show Roles List',
                'guard_name' => 'admin',
                'database_route_id' => 32,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 18,
                'name' => 'Show Create Role Page',
                'guard_name' => 'admin',
                'database_route_id' => 33,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 19,
                'name' => 'Give Store Role Page',
                'guard_name' => 'admin',
                'database_route_id' => 34,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 20,
                'name' => 'Show Edit Role Page',
                'guard_name' => 'admin',
                'database_route_id' => 35,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 21,
                'name' => 'Give Update Role Page',
                'guard_name' => 'admin',
                'database_route_id' => 36,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 22,
                'name' => 'Access List',
                'guard_name' => 'admin',
                'database_route_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 23,
                'name' => 'Assign User Access',
                'guard_name' => 'admin',
                'database_route_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 24,
                'name' => 'Show Permissions List',
                'guard_name' => 'admin',
                'database_route_id' => 1,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 25,
                'name' => 'Show Create Permission Page',
                'guard_name' => 'admin',
                'database_route_id' => 2,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 26,
                'name' => 'Show Edit Permission Page',
                'guard_name' => 'admin',
                'database_route_id' => 4,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 27,
                'name' => 'Give Store Permission Page',
                'guard_name' => 'admin',
                'database_route_id' => 3,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 28,
                'name' => 'Give Update Permission Page',
                'guard_name' => 'admin',
                'database_route_id' => 5,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 29,
                'name' => 'Social Links',
                'guard_name' => 'admin',
                'database_route_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 30,
                'name' => 'Dashboard',
                'guard_name' => 'admin',
                'database_route_id' => 52,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 31,
                'name' => 'Show Database Routes',
                'guard_name' => 'admin',
                'database_route_id' => 7,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 32,
                'name' => 'Show Create Database Route Page',
                'guard_name' => 'admin',
                'database_route_id' => 8,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 33,
                'name' => 'Give Store Database Route Page',
                'guard_name' => 'admin',
                'database_route_id' => 9,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 34,
                'name' => 'Show Edit Database Route Page',
                'guard_name' => 'admin',
                'database_route_id' => 10,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 35,
                'name' => 'Give Update Database Route Page',
                'guard_name' => 'admin',
                'database_route_id' => 11,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 36,
                'name' => 'Show Media List',
                'guard_name' => 'admin',
                'database_route_id' => 50,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 37,
                'name' => 'Show Create Media Page',
                'guard_name' => 'admin',
                'database_route_id' => 51,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 38,
                'name' => 'Give Store Media Page',
                'guard_name' => 'admin',
                'database_route_id' => 52,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 39,
                'name' => 'Show Edit Media Page',
                'guard_name' => 'admin',
                'database_route_id' => 53,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 40,
                'name' => 'Give Update Media Page',
                'guard_name' => 'admin',
                'database_route_id' => 54,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 41,
                'name' => 'Give Store Admin Menus Page',
                'guard_name' => 'admin',
                'database_route_id' => 16,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 42,
                'name' => 'Give Update Admin Menus Page',
                'guard_name' => 'admin',
                'database_route_id' => 18,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],


            [
                'id' => 43,
                'name' => 'Show Front Menus Module List',
                'guard_name' => 'admin',
                'database_route_id' => 38,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 44,
                'name' => 'Show Create Front Menus Module Page',
                'guard_name' => 'admin',
                'database_route_id' => 39,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 45,
                'name' => 'Give Store Front Menus Module',
                'guard_name' => 'admin',
                'database_route_id' => 40,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 46,
                'name' => 'Show Edit Front Menus Module Page',
                'guard_name' => 'admin',
                'database_route_id' => 41,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 47,
                'name' => 'Give Update Front Menus Module Page',
                'guard_name' => 'admin',
                'database_route_id' => 42,
                'deleted_at' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
        ]);
    }
}

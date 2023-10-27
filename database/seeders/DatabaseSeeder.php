<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // To access any menu we need to provide menu a permission.
        // So first need to create all permissions
        $this->call([
            DatabaseRouteSeeder::class,

            // Do not comment this PermissionSeeder::class call. 
            // It creates permissions for menus.
            PermissionSeeder::class,

            // You can add or remove common admin menus from here.
            MenuSeeder::class,

            // The RoleSeeder::class creates role
            // To add any new role edit this class
            RoleSeeder::class,

            // Do not remove SuperAdminSeeder::class call
            // It creates a SuperAdmin user
            // You can get AdminUser details from this class
            // Edit credentials if you want.
            SuperAdminSeeder::class,

            // AdminUsersSeeder::class, // Comment this class call If don't want dummy admin users.
            // UserSeeder::class, // Comment this class call If don't want dummy frontend users.

            PageSeeder::class,
        ]);
    }
}

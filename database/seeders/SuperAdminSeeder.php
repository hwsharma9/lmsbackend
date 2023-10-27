<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('admins')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = Admin::create([
            'username' => 'Harshwardhan',
            'first_name' => 'Harshwardhan',
            'last_name' => 'Sharma',
            'mobile' => '7879651192',
            'email' => 'hw.sharma9@gmail.com',
            'designation' => 'Super Admin',
            'status' => 1,
            'email_verified_at' => now(),
            // To create new password just run below commands
            // php artisan tinker
            // Hash::make('newpassword'); Copy and paste the Sha1 String
            // Easy right? :)
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);
        $role = Role::find(1);
        $user->assignRole($role);
    }
}

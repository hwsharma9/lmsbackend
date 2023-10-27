<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::select('name')->where('name', '!=', 'Super Admin')->pluck('name')->all();
        for ($i = 0; $i < 10; $i++) {
            shuffle($roles);
            Admin::factory(1)->create([
                'designation' => $roles[0]
            ]);
        }
        $users = Admin::whereNotIn('designation', ['Super Admin'])->get();
        foreach ($users as $key => $user) {
            $user->assignRole(rand(2, 4));
        }
    }
}

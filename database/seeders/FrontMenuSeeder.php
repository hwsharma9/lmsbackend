<?php

namespace Database\Seeders;

use App\Models\FrontMenuModule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrontMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('front_menu_modules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $front_menu_modules = [];
        FrontMenuModule::insert($front_menu_modules);
    }
}

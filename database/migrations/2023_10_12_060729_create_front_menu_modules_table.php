<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontMenuModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_menu_modules', function (Blueprint $table) {
            $table->id();
            $table->string('module_name', 100);
            $table->string('module_url', 100);
            // $table->integer('type_id');
            // $table->integer('page_module_link');
            // $table->integer('page_id')->default(0);
            // $table->integer('module_id')->default(0);
            // $table->string('custom_url', 255);
            // $table->text('html_block');
            // $table->string('attachment', 255);
            // $table->string('icon_class', 40);
            // $table->string('title_hi', 150);
            // $table->string('title_en', 150);
            // $table->boolean('mega_menu')->default(0);
            // $table->integer('parent_id')->default(0);
            // $table->integer('tab_same_new')->default(0)->comment('1=Same, 2=Newew');
            // $table->integer('menu_order')->default(1);
            $table->string('added_by')->nullable();
            $table->string('edit_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_menus');
    }
}

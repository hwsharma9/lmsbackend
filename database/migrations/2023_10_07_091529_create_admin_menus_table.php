<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name', 40)->nullable();
            $table->string('controller_name', 50)->default('#');
            $table->string('icon_class', 50)->nullable();
            $table->integer('p_menu_id')->nullable();
            $table->integer('s_order')->nullable();
            $table->string('class_id', 15)->nullable();
            $table->string('action', 50)->nullable();
            $table->foreignIdFor(Permission::class)->nullable();
            $table->tinyInteger('tab_same_new')->default(1)->comment("1 for same, 2 fro new");
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('admin_menus');
    }
}

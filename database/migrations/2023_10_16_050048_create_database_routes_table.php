<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_routes', function (Blueprint $table) {
            $table->id();
            $table->string('resides_at')->default('manage')->nullable();
            $table->string('controller_name');
            $table->string('route');
            $table->string('named_route');
            $table->string('method');
            $table->string('function_name');
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
        Schema::dropIfExists('database_routes');
    }
}

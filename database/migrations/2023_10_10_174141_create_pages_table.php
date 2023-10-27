<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->string('title_hi', 255);
            $table->text('description_hi');
            $table->string('title_en', 255);
            $table->text('description_en');
            $table->string('pre_url', 50)->default('page/content/');
            $table->string('slug', 100);
            $table->timestamp('added_date')->nullable();
            $table->string('added_by')->default(0);
            $table->timestamp('edit_date')->nullable();
            $table->string('edit_by')->default(0);
            $table->boolean('status')->default(1);
            $table->string('meta_title', 200)->nullable();
            $table->string('meta_keyword', 200)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->boolean('is_default')->default(0);
            $table->boolean('is_on_homepage')->default(0);
            $table->string('banner', 200)->nullable();
            $table->boolean('is_sidebar')->default(0);
            $table->integer('sidebar_id');
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
        Schema::dropIfExists('pages');
    }
}

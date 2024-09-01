<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('uid')->unique();
            $table->string('banner_name', 200);
            $table->string('banner_name_file_name', 200);
            $table->string('banner_title')->nullable();
            $table->string('banner_description')->nullable();
            $table->string('banner_first_link')->nullable();
            $table->string('banner_first_link_text')->nullable();
            $table->string('banner_second_link')->nullable();
            $table->string('banner_second_link_text')->nullable();
            $table->string('banner_sequence')->nullable();
            $table->enum('banner_status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}

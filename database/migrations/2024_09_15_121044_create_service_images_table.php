<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('uid')->unique();
            $table->unsignedBigInteger('service_uid');
            $table->string('service_image_name', 200);
            $table->string('service_image_file_name', 200);
            $table->enum('service_image_type', ['banner', 'preview_1', 'preview_2', 'general']);
            $table->text('service_image_description');
            $table->integer('service_image_sequence')->unsigned()->nullable();
            $table->enum('service_image_status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('service_uid')->references('uid')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_images');
    }
}

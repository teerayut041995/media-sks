<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('uid')->unique();
            $table->string('service_name', 200);
            $table->enum('service_type', ['service_unit', 'classroom', 'parallel_school', 'hospital']);
            $table->text('service_description');
            $table->text('service_mission')->nullable();
            $table->text('service_learning_activity')->nullable();
            $table->string('service_contact_phone_number', 100);
            $table->string('service_contact_name', 200);
            $table->text('service_address');
            $table->text('service_embed_map')->nullable();
            $table->integer('service_sequence')->unsigned()->nullable();
            $table->enum('service_status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('services');
    }
}

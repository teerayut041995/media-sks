<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name')->default('');
            $table->string('topics')->default('');
            $table->string('lecturer')->default('');
            $table->text('nullable')->null();
            $table->text('embed_video');
            $table->enum('live_status' , ['0', '1' , '2'])->default('0');
            $table->enum('publishing_status' , ['0', '1'])->default('0');
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
        Schema::dropIfExists('media');
    }
}

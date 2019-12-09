<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventValidationAppendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_validation_append', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_validation_id');
            $table->foreign('event_validation_id')->references('id')->on('event_validation')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('append_id');
            $table->foreign('append_id')->references('id')->on('appends')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['event_validation_id', 'append_id']);

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
        Schema::dropIfExists('event_validation_append');
    }
}

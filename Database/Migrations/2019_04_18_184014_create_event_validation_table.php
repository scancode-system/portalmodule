<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_validation', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('validation_id');
            $table->foreign('validation_id')->references('id')->on('validations')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['event_id', 'validation_id']);

            $table->string('original_file')->nullable();
            $table->string('debug_file')->nullable();
            $table->string('clean_file')->nullable();
            $table->longText('report')->nullable();



            $table->integer('validated')->default(0);
            $table->integer('modified')->default(0);
            $table->integer('duplicates')->default(0);
            $table->integer('failures')->default(0);


            $table->string('file')->nullable();
            $table->dateTime('update')->nullable();

            $table->unsignedBigInteger('status_id')->default(1);
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('event_validation');
    }
}

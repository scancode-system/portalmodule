<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_validation', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('validation_id');
            $table->foreign('validation_id')->references('id')->on('validations')->onDelete('restrict')->onUpdate('cascade');

            $table->unique(['client_id', 'validation_id']);

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
        Schema::dropIfExists('client_validation');
    }
}

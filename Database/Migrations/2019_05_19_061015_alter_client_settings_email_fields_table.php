<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientSettingsEmailFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_settings', function (Blueprint $table) {
            $table->string('email_from')->default('Scancode')->after('note');
            $table->string('email_subject')->default('Fechamento de Pedido')->after('email_from');
            $table->text('email_note')->after('email_subject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_settings', function (Blueprint $table) {
            $table->dropColumn(['email_from', 'email_subject', 'email_note']);
        });
    }
}

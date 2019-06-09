<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterValidationAddModuleNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('validations', function (Blueprint $table) {
            $table->string('module_name')->after('alias')->unique();
            $table->string('module_alias')->after('alias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('validations', function (Blueprint $table) {
            $table->dropColumn(['module_name', 'module_alias']);
        });
    }
}

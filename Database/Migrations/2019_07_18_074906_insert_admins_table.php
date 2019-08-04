<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Portal\Entities\Admin;

class InsertAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Admin::insert([[
            'id' => 1, 
            'name' => 'scancode',
            'email' => 'suporte@scancode.com.br',
            'password' => bcrypt('12345678')
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Admin::destroy(1);
    }
}

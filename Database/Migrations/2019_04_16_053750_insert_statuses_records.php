<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Status;

class InsertStatusesRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Status::insert([
            ['id' => 1, 'alias' => 'pendente'],
            ['id' => 2, 'alias' => 'completo']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Status::destroy(1, 2);
    }
}

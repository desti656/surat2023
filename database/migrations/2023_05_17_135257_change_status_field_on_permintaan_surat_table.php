<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\{StringType, Type};

class ChangeStatusFieldOnPermintaanSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE permintaan_surat MODIFY COLUMN status ENUM('pending', 'onprogress', 'declined', 'done')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("ALTER TABLE permintaan_surat MODIFY COLUMN status ENUM('pending', 'onprogress', 'declined', 'accepted')");
    }
}

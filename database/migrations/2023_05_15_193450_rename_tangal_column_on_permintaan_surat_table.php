<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTangalColumnOnPermintaanSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permintaan_surat', function(Blueprint $table) {
            $table->renameColumn('tangal', 'tanggal')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permintaan_surat', function(Blueprint $table) {
            $table->renameColumn('tanggal', 'tangal')->change();
        });
    }
}

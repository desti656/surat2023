<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToIdPetugasOnPermintaanSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permintaan_surat', function (Blueprint $table) {
            $table->bigInteger('id_petugas', false, true)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permintaan_surat', function (Blueprint $table) {
            $table->bigInteger('id_petugas', false, true)->nullable();
        });
    }
}

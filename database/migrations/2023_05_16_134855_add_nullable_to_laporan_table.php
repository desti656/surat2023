<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->bigInteger('id_surat_masuk', false, true)->nullable()->change();
            $table->bigInteger('id_surat_keluar', false, true)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->bigInteger('id_surat_masuk', false, true)->change();
            $table->bigInteger('id_surat_keluar', false, true)->change();
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForeignKeyOnLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan', function(Blueprint $table) {
            $table->dropForeign('laporan_id_surat_masuk_foreign');
            $table->dropForeign('laporan_id_surat_keluar_foreign');
            $table->foreign('id_surat_masuk')->references('id')->on('surat_masuk')->cascadeOnDelete();
            $table->foreign('id_surat_keluar')->references('id')->on('surat_keluar')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan', function(Blueprint $table) {
            $table->dropForeign('laporan_id_surat_masuk_foreign');
            $table->dropForeign('laporan_id_surat_keluar_foreign');
            $table->foreign('id_surat_masuk')->references('id')->on('surat_masuk');
            $table->foreign('id_surat_keluar')->references('id')->on('surat_keluar');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForeignKeyOnSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_keluar', function(Blueprint $table) {
            $table->dropForeign('surat_keluar_id_permintaan_surat_foreign');
            $table->foreign('id_permintaan_surat')->references('id')->on('permintaan_surat')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_keluar', function(Blueprint $table) {
            $table->dropForeign('surat_keluar_id_permintaan_surat_foreign');
            $table->foreign('id_permintaan_surat')->references('id')->on('permintaan_surat');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPersyaratanSuratToUploadDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upload_dokumen', function (Blueprint $table) {
            $table->dropForeign('upload_dokumen_id_jenis_surat_foreign');
            $table->dropColumn('id_jenis_surat');
            $table->bigInteger('id_persyaratan', false, true)->after('id_permintaan_surat');
            $table->foreign('id_persyaratan')->references('id')->on('persyaratan')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upload_dokumen', function (Blueprint $table) {
            $table->dropForeign('upload_dokumen_id_persyaratan_foreign');
            $table->dropColumn('id_persyaratan');
            $table->bigInteger('id_jenis_surat', false, true)->after('id_permintaan_surat');
            $table->foreign('id_jenis_surat')->references('id')->on('jenis_surat')->cascadeOnDelete();
        });
    }
}

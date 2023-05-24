<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_dokumen', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_permintaan_surat', false, true);
            $table->text('file');
            $table->timestamps();

            $table->foreign('id_permintaan_surat')->references('id')->on('permintaan_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_dokumen');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_surat_masuk', false, true);
            $table->bigInteger('id_surat_keluar', false, true);
            $table->timestamps();

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
        Schema::dropIfExists('laporan');
    }
}

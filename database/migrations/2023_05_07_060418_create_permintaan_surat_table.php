<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_surat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_jenis_surat', false, true);
            $table->bigInteger('id_pengaju', false, true);
            $table->date('tangal');
            $table->text('keterangan');
            $table->enum('status', ['pending', 'onprogress', 'declined', 'accepted'])->default('pending');
            $table->bigInteger('id_petugas', false, true);
            $table->date('confirm_at')->nullable();
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();

            $table->foreign('id_jenis_surat')->references('id')->on('jenis_surat');
            $table->foreign('id_pengaju')->references('id')->on('users');
            $table->foreign('id_petugas')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permintaan_surat');
    }
}

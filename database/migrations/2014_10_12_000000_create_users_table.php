<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->text('address')->nullable();
            $table->text('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Budha', 'Hindu', 'Konghuchu'])->nullable();
            $table->enum('pekerjaan', ['BELUM / TIDAK BEKERJA', 'MENGURUS RUMAH TANGGA', 'PELAJAR / MAHASISWA', 'PENSIUNAN', 'PEGAWAI NEGERI SIPIL'])->nullable();
            $table->enum('status_perkawinan', ['BELUM KAWIN','KAWIN','CERAI HIDUP','CERAI MATI'])->nullable();
            $table->string('no_kk', 16)->nullable();
            $table->smallInteger('role_id', false, true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->id();
            $table->string('qr_code');
            $table->string('name');
            $table->string('alamat');
            $table->string('profesi');
            $table->string('instansi');
            $table->string('no_telp');
            $table->unsignedInteger('umur');
            $table->date('tanggal');
            $table->enum('status', ['Belum Hadir', 'Sudah Hadir'])->default('Belum Hadir');
            $table->string('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengunjungs');
    }
};

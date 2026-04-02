<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkreditasiInstitusiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akreditasi_institusi', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pt'); // Nama Perguruan Tinggi
            $table->string('peringkat'); // A, B, Unggul, dll
            $table->text('nomor_sk');

            $table->year('tahun_sk');

            $table->date('tgl_berlaku');
            $table->date('tgl_kadaluarsa');

            $table->string('file')->nullable();

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
        Schema::dropIfExists('akreditasi_institusi');
    }
}

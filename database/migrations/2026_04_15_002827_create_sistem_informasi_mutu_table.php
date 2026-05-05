<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistemInformasiMutuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('sistem_informasi_mutu', function (Blueprint $table) {
        $table->id();
        $table->string('nama_penyelenggara');
        $table->string('singkatan');
        $table->string('link')->nullable();
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
        Schema::dropIfExists('sistem_informasi_mutu');
    }
}

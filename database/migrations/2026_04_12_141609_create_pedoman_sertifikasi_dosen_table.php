<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedomanSertifikasiDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('pedoman_sertifikasi_dosen', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->string('file');
    $table->integer('urutan')->nullable();
    $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('pedoman_sertifikasi_dosen');
    }
}

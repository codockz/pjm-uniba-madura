<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalenderMutuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('kalender_mutu', function (Blueprint $table) {
        $table->id();
        $table->year('tahun'); // contoh: 2022, 2023
        $table->string('judul')->nullable(); // opsional
        $table->string('file'); // path file (pdf/gambar)
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
        Schema::dropIfExists('kalender_mutu');
    }
}

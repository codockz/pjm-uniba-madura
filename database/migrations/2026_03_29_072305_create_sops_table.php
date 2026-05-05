<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sops', function (Blueprint $table) {
        $table->id();
        $table->string('judul');        // Judul SOP
        $table->string('file');         // File PDF
        $table->text('deskripsi')->nullable(); // Opsional
        $table->string('tahun')->nullable();   // 🔥 tambahan biar konsisten dengan yang lain
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
        Schema::dropIfExists('sops');
    }
}

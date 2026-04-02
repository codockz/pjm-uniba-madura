<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaIndukPengembangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_induk_pengembangans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->year('tahun')->nullable();
            $table->string('gambar')->nullable();
            $table->string('file')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('rencana_induk_pengembangans');
    }
}

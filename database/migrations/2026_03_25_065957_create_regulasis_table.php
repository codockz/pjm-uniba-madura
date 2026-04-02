<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegulasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulasis', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('sumber_dokumen');
            $table->string('nomor');
            $table->text('tentang');
            $table->string('file'); // simpan path file
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
        Schema::dropIfExists('regulasis');
    }
}

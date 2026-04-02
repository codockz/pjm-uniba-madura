<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesorBKDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesor_b_k_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dosen');
            $table->string('nira')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('periode')->nullable();
            $table->timestamps();
            $table->foreignId('program_studi_id')->constrained('program_studis')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asesor_b_k_d_s');
    }
}

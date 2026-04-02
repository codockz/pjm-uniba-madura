<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveiPemangkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('survei_pemangku', function (Blueprint $table) {
            $table->id();
            $table->string('pengisi');
            $table->string('kepuasan_text')->nullable();
            $table->text('link_kepuasan')->nullable();
            $table->string('evaluasi_text')->nullable();
            $table->text('link_evaluasi')->nullable();
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
        Schema::dropIfExists('survei_pemangku');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatuaOrtakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statua_ortakers', function (Blueprint $table) {
            $table->id();
            $table->text('judul');
            $table->string('file');
            $table->year('tahun');
            $table->timestamps();
            $table->integer('urutan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statua_ortakers');
    }
}

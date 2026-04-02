<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKebijakanRektorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('kebijakan_rektors', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('nomor')->nullable();
            $table->string('dokumen')->nullable();
            $table->text('tentang');
            $table->date('tanggal_terbit')->nullable();
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
        Schema::dropIfExists('kebijakan_rektors');
    }
}

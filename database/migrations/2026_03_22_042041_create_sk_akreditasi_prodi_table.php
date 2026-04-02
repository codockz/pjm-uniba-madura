<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkAkreditasiProdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_akreditasi_prodi', function (Blueprint $table) {
            $table->id();
            $table->string('program_studi');
            $table->string('jenjang');
            $table->text('sk_izin');
            $table->string('akreditasi');
            $table->text('sk_akreditasi');
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
        Schema::dropIfExists('sk_akreditasi_prodi');
    }
}

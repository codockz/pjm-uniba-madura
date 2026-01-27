<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTupoksiPjmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tupoksi_pjms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_tupoksi_id')->references('id')->on('kategori_tupoksi_pjms')->onDelete('cascade');
            $table->text('isi_tupoksi',1000);
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
        Schema::dropIfExists('tupoksi_pjms');
    }
}

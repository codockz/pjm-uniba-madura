<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_footers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lokasi');
            $table->string('g_map');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('no_telp');
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
        Schema::dropIfExists('content_footers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('sidebar_categories', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kategori');
        $table->string('slug')->unique();
        $table->integer('urutan')->default(0);
        $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('sidebar_categories');
    }
}

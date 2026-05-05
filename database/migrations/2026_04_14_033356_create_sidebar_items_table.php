<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('sidebar_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')
              ->constrained('sidebar_categories')
              ->onDelete('cascade');

        $table->string('judul');
        $table->string('link')->nullable();
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
        Schema::dropIfExists('sidebar_items');
    }
}

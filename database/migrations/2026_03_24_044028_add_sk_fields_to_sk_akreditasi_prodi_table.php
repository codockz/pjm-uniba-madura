<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkFieldsToSkAkreditasiProdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sk_akreditasi_prodi', function (Blueprint $table) {
            $table->string('sk_izin_text')->nullable();
            $table->string('file_sk_izin')->nullable();
            $table->string('sk_akreditasi_text')->nullable();
            $table->string('file_sk_akreditasi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sk_akreditasi_prodi', function (Blueprint $table) {
            $table->dropColumn(['sk_izin_text', 'file_sk_izin', 'sk_akreditasi_text', 'file_sk_akreditasi']);
        });
    }
}

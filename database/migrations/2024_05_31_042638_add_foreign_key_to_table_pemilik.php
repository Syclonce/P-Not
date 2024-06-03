<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemilik', function (Blueprint $table) {
            $table->foreign('provinsi')->references('kode')->on('provinsi')->onDelete('cascade');
            $table->foreign('kab')->references('kode')->on('kabupaten')->onDelete('cascade');
            $table->foreign('kec')->references('kode')->on('kecamatan')->onDelete('cascade');
            $table->foreign('kel_des')->references('kode')->on('desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemilik', function (Blueprint $table) {
            $table->dropForeign(['provinsi']);
            $table->dropForeign(['kab']);
            $table->dropForeign(['kec']);
            $table->dropForeign(['kel_des']);
        });
    }
};

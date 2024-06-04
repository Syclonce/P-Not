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
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn('nama_pem');
            $table->dropColumn('merek');
            $table->dropColumn('model');
            $table->dropColumn('no_pol');
            $table->dropColumn('kode_merek');

            $table->bigInteger('pemilik_id'); 
            $table->bigInteger('merek_kendaraan_id'); 
            $table->unsignedBigInteger('pemilik_id')->change();
            $table->unsignedBigInteger('merek_kendaraan_id')->change();

            $table->foreign('pemilik_id')->references('id')->on('pemilik')->onDelete('cascade');
            $table->foreign('merek_kendaraan_id')->references('id')->on('merek_kendaraan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropForeign(['pemilik_id']);
            $table->dropForeign(['merek_kendaraan_id']);

            $table->dropColumn('pemilik_id');
            $table->dropColumn('merek_kendaraan_id');
        });
    }
};

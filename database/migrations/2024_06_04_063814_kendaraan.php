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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pajak');
            $table->date('tgl_stnk');
            $table->timestamps();

            // Define foreign key columns with the correct data type
            $table->unsignedBigInteger('pemilik_id');
            $table->unsignedBigInteger('merek_kendaraan_id');

            // Define foreign key constraints
            $table->foreign('pemilik_id')->references('id')->on('pemilik')->onDelete('cascade');
            $table->foreign('merek_kendaraan_id')->references('id')->on('merek_kendaraan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};

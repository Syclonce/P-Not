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
            $table->string('no_pol');
            $table->string('nama_pem');
            $table->string('merek');
            $table->text('model');
            $table->text('kode_merek');
            $table->datetimes('tgl_buat');
            $table->datetimes('tgl_pajak');
            $table->datetimes('tgl_stnk');
            $table->timestamps();
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

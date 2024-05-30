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
        Schema::create('pemilik', function (Blueprint $table) {
            $table->id();
            $table->string('no_polisi');
            $table->string('nama_pemilik');
            $table->longText('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kel_des');
            $table->string('kec');
            $table->string('kab');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilik');
    }
};

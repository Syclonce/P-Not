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
            $table->date('tgl_bayar_pajak')->nullable();
            $table->date('tgl_bayar_stnk')->nullable();
            $table->string('status_bayar_stnk')->nullable();
            $table->string('status_bayar_pajak')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kendaraan', function (Blueprint $table) {
        
            $table->dropColumn('tgl_bayar_pajak');
            $table->dropColumn('tgl_bayar_stnk');
            $table->dropColumn('status_bayar_stnk');
            $table->dropColumn('status_bayar_pajak');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};

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
            Schema::table('pemilik', function (Blueprint $table) {
                $table->string('created_by')->nullable()->change();
                $table->string('updated_by')->nullable()->change();
                $table->string('rt')->nullable()->change();
                $table->string('rw')->nullable()->change();
                $table->string('kode_pos')->nullable()->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemilik', function (Blueprint $table) {
            $table->string('created_by')->nullable(false)->change();
            $table->string('updated_by')->nullable(false)->change();
            $table->string('rt')->nullable(false)->change();
            $table->string('rw')->nullable(false)->change();
            $table->string('kode_pos')->nullable(false)->change();        
        });
    }
};

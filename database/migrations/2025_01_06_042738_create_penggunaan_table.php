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
        Schema::create('penggunaan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_penggunaan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('bulan');
            $table->string('tahun');
            $table->bigInteger('meter_awal');
            $table->bigInteger('meter_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan');
    }
};

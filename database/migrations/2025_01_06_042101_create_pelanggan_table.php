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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_pelanggan');
            $table->string('username');
            $table->string('password');
            $table->bigInteger('nomor_kwh');
            $table->string('nama_pelanggan');
            $table->string('alamat');
            $table->unsignedBigInteger('id_tarif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_pembelian_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pembelian');
            $table->date('tanggal');
            $table->string('kode_barang', 30);
            $table->decimal('qty', 10, 2);
            $table->decimal('harga', 10, 2);
            $table->decimal('diskon');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('kode_barang')
                ->references('kode_barang')
                ->on('master_barang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_pembelian_barang');
    }
};

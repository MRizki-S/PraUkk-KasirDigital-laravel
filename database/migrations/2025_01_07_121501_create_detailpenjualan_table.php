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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->UnsignedbigInteger('penjualan_id');
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->onDelete('cascade');

            $table->UnsignedbigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');

            $table->integer('jumlah_produk');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};

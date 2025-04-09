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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Bisa tanpa user login
            $table->string('nama_pemesan');
            $table->string('email')->nullable();
            $table->string('no_handphone');
            $table->string('nama_tamu');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('kamar_type_id');
            $table->foreign('kamar_type_id')->references('id')->on('kamar_type')->onDelete('cascade');

            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('jumlah_kamar');

            // Harga total dihitung dari jumlah malam x jumlah kamar x harga_permalam
            $table->decimal('total_harga', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

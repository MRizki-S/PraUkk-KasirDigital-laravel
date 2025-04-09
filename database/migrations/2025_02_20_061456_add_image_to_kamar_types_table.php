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
        Schema::table('kamar_type', function (Blueprint $table) {
            $table->string('image')->nullable()->after('harga_permalam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kamar_type', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};

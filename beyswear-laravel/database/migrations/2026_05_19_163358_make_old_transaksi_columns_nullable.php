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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('produk')->nullable()->change();
            $table->string('ukuran')->nullable()->change();
            $table->string('warna')->nullable()->change();
            $table->integer('qty')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('produk')->nullable(false)->change();
            $table->string('ukuran')->nullable(false)->change();
            $table->string('warna')->nullable(false)->change();
            $table->integer('qty')->nullable(false)->change();
        });
    }
};

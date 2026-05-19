<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk_varians', function (Blueprint $table) {
            $table->string('ukuran')->nullable()->change();
            $table->string('warna')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('produk_varians', function (Blueprint $table) {
            $table->string('ukuran')->nullable(false)->change();
            $table->string('warna')->nullable(false)->change();
        });
    }
};
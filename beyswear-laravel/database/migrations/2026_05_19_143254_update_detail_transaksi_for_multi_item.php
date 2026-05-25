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
        Schema::table('detail_transaksi', function (Blueprint $table) {
            if (!Schema::hasColumn('detail_transaksi', 'produk')) {
                $table->string('produk')->nullable();
            }

            if (!Schema::hasColumn('detail_transaksi', 'ukuran')) {
                $table->string('ukuran')->nullable();
            }

            if (!Schema::hasColumn('detail_transaksi', 'warna')) {
                $table->string('warna')->nullable();
            }

            if (!Schema::hasColumn('detail_transaksi', 'qty')) {
                $table->integer('qty')->default(1);
            }

            if (!Schema::hasColumn('detail_transaksi', 'harga')) {
                $table->decimal('harga', 12, 2)->default(0);
            }

            if (!Schema::hasColumn('detail_transaksi', 'subtotal')) {
                $table->decimal('subtotal', 12, 2)->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropColumn([
                'produk',
                'ukuran',
                'warna',
                'qty',
                'harga',
                'subtotal'
            ]);
        });
    }
};

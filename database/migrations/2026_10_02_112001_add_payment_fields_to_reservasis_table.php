<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('metode_pembayaran')->nullable()->after('total_harga');
            $table->string('status_pembayaran')
                ->default('belum_bayar')
                ->after('metode_pembayaran');
            $table->timestamp('dibayar_pada')
                ->nullable()
                ->after('status_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn([
                'metode_pembayaran',
                'status_pembayaran',
                'dibayar_pada',
            ]);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lapangan');
            $table->string('jenis_lapangan')->default('Indoor');
            $table->unsignedInteger('harga_per_jam');
            $table->unsignedInteger('kapasitas')->default(4);
            $table->text('fasilitas')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};
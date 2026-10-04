<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedInteger('durasi_jam');
            $table->unsignedInteger('total_harga')->default(0);
            $table->string('status')->default('menunggu');
            $table->timestamps();

            $table->index(['lapangan_id', 'tanggal']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
};

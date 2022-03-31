<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewaRuangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa_ruang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruang_id')->constrained('ruang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('invoice');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('keperluan');
            $table->enum('proses', ['Ditolak', 'Dalam Proses', 'Disewa', 'Dikembalikan'])->default('Dalam Proses');
            $table->enum('status', ['pending', 'success', 'failed', 'expired']);
            $table->string('snap_token')->nullable();
            $table->bigInteger('grand_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sewa_ruang');
    }
}

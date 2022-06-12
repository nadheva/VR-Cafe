<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewaStudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa_studio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studio_id')->constrained('studio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('invoice');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_berakhir');
            $table->text('keperluan');
            $table->enum('proses', ['Ditolak', 'Dalam Proses', 'Disewa', 'Dikembalikan'])->default('Dalam Proses');
            $table->boolean('approval')->default(0);
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
        Schema::dropIfExists('sewa_studio');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_ruang_id')->constrained('sewa_ruang')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('sewa_perangkat_id')->constrained('sewa_perangkat')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('perangkat_id')->constrained('perangkat')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('ruang_id')->constrained('ruang')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('jumlah');
            $table->bigInteger('harga');
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
        Schema::dropIfExists('order');
    }
}

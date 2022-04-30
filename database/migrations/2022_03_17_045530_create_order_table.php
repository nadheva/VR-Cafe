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
            // $table->foreignId('sewa_ruang_id')->nullable()->constrained('sewa_ruang')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('invoice_id')->nullable()->constrained('invoice')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('perangkat_id')->nullable()->constrained('perangkat')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            // $table->foreignId('ruang_id')->nullable()->constrained('ruang')->onDelete('cascade')->onUpdate('cascade')->unsigned();
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

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
            // $table->foreignId('sewa_studio_id')->nullable()->constrained('sewa_studio')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('sewa_perangkat_id')->nullable()->constrained('sewa_perangkat')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('perangkat_id')->nullable()->constrained('perangkat')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            // $table->foreignId('studio_id')->nullable()->constrained('studio')->onDelete('cascade')->onUpdate('cascade')->unsigned();
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

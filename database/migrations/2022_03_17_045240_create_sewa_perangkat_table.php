<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewaPerangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa_perangkat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('tipe',['sewa_perangkat', 'sewa_ruang', 'denda']);
            $table->text('invoice');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('keperluan');
            $table->enum('proses',['Disewa', 'Dikembalikan']);
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
        Schema::dropIfExists('sewa_perangkat');
    }
}

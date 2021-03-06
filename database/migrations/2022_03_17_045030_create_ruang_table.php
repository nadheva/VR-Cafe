<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateRuangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_ruang');
            $table->string('nama');
            $table->string('slug');
            $table->string('gambar');
            $table->longText('gambar_detail');
            $table->string('banner');
            $table->bigInteger('harga');
            $table->bigInteger('jumlah');
            $table->bigInteger('ukuran');
            $table->bigInteger('monitor');
            $table->bigInteger('perangkat_vr');
            $table->bigInteger('pc_desktop');
            $table->text('deskripsi');
            $table->foreignId('resepsionis_id')->constrained('resepsionis')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ruang');
    }
}

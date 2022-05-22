<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_studio_id')->nullable()->constrained('sewa_studio')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('sewa_perangkat_id')->nullable()->constrained('sewa_perangkat')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('invoice')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'expired']);
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
        Schema::dropIfExists('denda');
    }
}

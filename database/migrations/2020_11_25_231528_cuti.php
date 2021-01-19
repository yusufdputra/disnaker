<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('alasan');
            $table->string('tujuan');
            $table->integer('lama');
            $table->string('tanggal_cuti');
            $table->string('penyetuju')->nullable();
            $table->string('jenis');
            $table->string('status');
            $table->string('pesan')->nullable();
            
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
        Schema::dropIfExists('cuti');
    }
}

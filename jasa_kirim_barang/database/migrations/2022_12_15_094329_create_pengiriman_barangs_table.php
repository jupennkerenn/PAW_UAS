<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('nama_pengirim');
            $table->string('telp_pengirim');
            $table->float('berat_barang');
            $table->string('jenis_barang');
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->string('estimasi');
            $table->string('nama_penerima');
            $table->string('telp_penerima');
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
        Schema::dropIfExists('pengiriman_barangs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penarikan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id');
            $table->date('tgl_expired');
            $table->enum('status', ['DITARIK', 'TIDAK DITARIK']);
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
        Schema::dropIfExists('penarikan_barang');
    }
}

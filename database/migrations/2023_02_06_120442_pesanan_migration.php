<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class pesananMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_menu');
            $table->string('id_pesanan');
            $table->string('jumlah_pesanan');
            $table->string('total_harga');
            $table->string('tunai');
            $table->string('no_meja');
            $table->string('waktu');
            $table->enum('ekstra_waktu', ['true', 'false'])->default('false');
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
        //
    }
}

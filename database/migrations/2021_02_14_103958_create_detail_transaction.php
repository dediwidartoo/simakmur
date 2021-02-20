<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaction', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('transaksi_id');
            // $table->unsignedBigInteger('produk_id');
            $table->foreignId('transaksi_id')->constrained('transaction');
            $table->foreignId('produk_id')->constrained('products');
            $table->string('produk',40);
            $table->integer('jumlah_barang');
            $table->decimal('harga',15,2);
            $table->decimal('total',15,2);
            $table->timestamps();

            // $table->foreign('transaksi_id')->references('id')->on('transaction');
            // $table->foreign('produk_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaction');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi',12);
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('total_akhir',15,2);
            $table->text('tujuan')->nullable();
            $table->enum('status_transaksi',['menunggu','tertunda','diproses','dikirim'])->default('menunggu');
            $table->datetime('tgl_transaksi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('prof_of_payment')->nullable();
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
        Schema::dropIfExists('transaction');
    }
}

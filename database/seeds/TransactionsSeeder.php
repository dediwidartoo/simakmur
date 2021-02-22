<?php

use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = array(
            array(
                'user_id' => '1',
                'kode_transaksi' => 'MR00001',
                'tujuan' => 'surabaya',
                'total_akhir' => '100000',
                'tgl_transaksi' => Carbon::now(),
                'status_transaksi' => 'menunggu',
                'prof_of_payment' => 'transaksi/c7psDj2cA2doWBUgYwjSvoruc0jNCGeqeLDPimxh.jpeg',
                'created_at' => Carbon::now()
            ),
            array(
                'user_id' => '1',
                'kode_transaksi' => 'MR00001',
                'tujuan' => 'surabaya',
                'total_akhir' => '100000',
                'tgl_transaksi' => Carbon::now(),
                'status_transaksi' => 'tertunda',
                'proof_of_payment'=> 'transaction/jAPBZVEgVQaUvppcsVGVQ2r2ixqLNV6etECCpLlJ.png',
                'created_at' => Carbon::now()
            ),
        );

        $detail_transactions = array(
            array(
                'transaksi_id' => '1',
                'produk_id' => '1',
                'produk' => 'hoodie',
                'jumlah_barang' => '2',
                'harga' => '90000.00',
                'total' => '100000',
                'created_at' => Carbon::now()),
            array(
                'transaksi_id' => '2',
                'produk_id' => '2',
                'produk' => 'Celana pendek joger',
                'jumlah_barang' => '2',
                'harga' => '90000.00',
                'total' => '180000.00',
                'created_at' => Carbon::now()),
            array(
                'transaksi_id' => '2',
                'produk_id' => '1',
                'produk' => 'hoodie',
                'jumlah_barang' => '1',
                'harga' => '300000.00',
                'total' => '100000',
                'created_at' => Carbon::now())
        );

        Transaction::insert($transactions);
        DetailTransaction::insert($detail_transactions);
    }
}

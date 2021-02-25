<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\User;
use App\Models\Notification;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with(['userRelation', 'detailRelation'])->paginate(10);

        return view('admin.transaction.index')->with(['transactions' => $transactions]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = DetailTransaction::with('productRelation')->where('transaksi_id', $id)->get();

        return view('admin.transaction.detail')->with(['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateProcess($id)
    {
        $trans = Transaction::where('id',$id)->where('status_transaksi','tertunda')->first();

        if ($trans == null) {
            return redirect()->back();
        }

        $deskripsi = "Pembayaran transaksi $trans->kode_transaksi sudah kami terima. Silahkan menunggu untuk pengiriman barang.";
        
        Notification::insert([
            'user_id'   => $trans->user_id,
            'transaksi_id' => $trans->id,
            'kode_transaksi' => $trans->kode_transaksi,
            'deskripsi' => $deskripsi,
        ]);

        $trans->update([
            'status_transaksi' => 'diproses'
        ]);

        return redirect()->back()->with([
            'status' => [
                'code'  => 200,
                'deskripsi' => 'Success'
            ]
        ]);
    }

}

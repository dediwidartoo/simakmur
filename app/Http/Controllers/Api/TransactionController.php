<?php

namespace App\Http\Controllers\Api;

use DB;
use Response;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function toko(Request $request)
    {
        // return Response::json($request->all());
        

        DB::beginTransaction();

        try {
            $transaksi = new Transaction;
            $transaksi->kode_transaksi = Transaction::GetCode();
            $transaksi->tujuan = $request->tujuan;
            $transaksi->user_id = $request->user_id;
            $transaksi->total_akhir = $request->total_akhir;
            $transaksi->save();

            foreach ($request->detail as $value) {
                $produk = Product::where('id',$value['produk_id'])->first();

                if ($produk->stok <= $value['jumlah_barang']) {
                    DB::rollback();

                    return Response::json([
                        'status' => [
                            'code'  => 400,
                            'deskripsi'  => 'Produk $produk->produk melebihi stok!',
                        ]
                    ], 400);
                }

                DetailTransaction::create([
                    'transaksi_id'  => $transaksi->id,
                    'produk_id'  => $produk->id,
                    'produk'  => $produk->produk,
                    'jumlah_barang'  => $value['jumlah_barang'],
                    'harga'  => $value['harga'],
                    'total'  => $value['total'],
                ]);

                $produk->decrement('stok', $value['jumlah_barang']);
            }

            DB::commit();

            return Response::json([
                'status' => [
                    'code'  => 201,
                    'deskripsi'  => 'Transaksi berhasil dibuat',
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            return Response::json([
                'status' => [
                    'code'  => 500,
                    'deskripsi'  => 'Internal Server error',
                ]
            ], 500);
        }
    }

    public function userTransaction($userId, $status=null)
    {
        // return Response::json($userId);
        $query = Transaction::with('userRelation')->orderBy('id','desc')->where('user_id', $userId);

        if ($status != null) {
            $query->where('status_transaksi', $status);
        }

        $tr = $query->paginate(10);

        // return $tr;
        if ($tr->isEmpty()) {
            return Response::json([
                'status' => [
                    'code'  => 400,
                    'description'   => 'Data tidak ditemukan!',
                ]
            ], 400);
        } else {
            return TransactionResource::collection($tr)->additional([
                'status' => [
                    'code'  => 200,
                    'description'   => 'Ok!',
                ]
            ])->response()->setStatusCode(200);
        }

        // return Response::json($tr);
    }

    public function byCode($code)
    {
        $tra = Transaction::with('userRelation', 'detailRelation')->where('kode_transaksi', $code)->first();
        if (Empty($tra)) {
            return Response::json([
                'status' => [
                    'code'      => 404,
                    'deskripsi' => 'Data tidak ditemukan'
                ]
            ],404);
        } else {
            return (new TransactionResource($tra))->additional([
                'status' => [
                    'code' => 200,
                    'description' => 'Ok!'
                ]
            ])->response()->setStatusCode(200);
        }
    }

    public function upload(Request $request, $code)
    {
        $tra = Transaction::where('kode_transaksi',$code)->first();

        if (Empty($tra)) {
            return Response::json([
                'status'    => [
                    'code'      => 404,
                    'deskripsi' => 'Data tidak temu'
                ]
            ], 404);
        }

        if ($request->hasFile('foto')) {
            $path = $request->foto->store('bukti');

            $tra->update([
                'prof_of_payment'   => $path,
            ]);

            return Response::json([
                'status'    => [
                    'code'      => 202,
                    'deskripsi' => 'Update diterima!'
                ]
            ], 202);
        }else {
            return Response::json([
                'status'    => [
                    'code'      => 404,
                    'deskripsi' => 'Data tidak temu'
                ]
            ], 404);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;

class TransactionApiController extends Controller
{
    public function index()
    {
        $tra = Transaction::with('userRelation')->paginate(10);

        if( $tra->isEmpty() ){
            return Response::json([
                "status" => [
                    "code" => 404,
                    "description" => "Not Found",
                ]
            ],404);
        }

        return TransactionResource::collection($tra)
        ->additional([
            "status" => [
                "code" => 200,
                "description" => "Not Found",
            ]
        ])->response()->setStatusCode(200);
    }

    public function store(Request $request)
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

            foreach ($request->detail as $detail) {
                $produk = Product::where('id',$detail['produk_id'])->first();

                if ($produk->stok <= $detail['jumlah_barang']) {
                    DB::rollback();

                    return Response::json([
                        'status' => [
                            'code'  => 403,
                            'deskripsi'  => "Produk $produk->produk melebihi stok!",
                        ]
                    ], 403);
                }

                // DetailTransaction::create([
                //     'transaksi_id'  => $transaksi->id,
                //     'produk_id'  => $produk->id,
                //     'produk'  => $produk->produk,
                //     'jumlah_barang'  => $detail['jumlah_barang'],
                //     'harga'  => $detail['harga'],
                //     'total'  => $detail['total'],
                // ]);
                $dtl = new DetailTransaction();
                $dtl->transaksi_id  = $transaksi->id;
                $dtl->produk        = $produk->produk;
                $dtl->produk_id     = $detail['produk_id'];
                $dtl->jumlah_barang = $detail['jumlah_barang'];
                $dtl->harga         = $detail['harga'];
                $dtl->total         = $detail['total'];
                $dtl->save();

                $produk->decrement('stok', $detail['jumlah_barang']);
            }

            DB::commit();

            return Response::json([
                'status' => [
                    'code'  => 201,
                    'deskripsi'  => 'Data Transaksi berhasil dibuat',
                ]
            ], 201);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        // catch (\Exception $e) {
        //     DB::rollback();
            // dd($e);

            // return Response::json([
            //     'status' => [
            //         'code'  => 500,
            //         'deskripsi'  => 'Internal Server error',
            //     ]
            // ], 500);
        // }
    }
    
    public function detail($code)
    {
        $tra = Transaction::with('userRelation', 'detailRelation')->where('kode_transaksi', $code)->first();
        if ($tra == null) {
            return Response::json([
                'status' => [
                    'code'      => 404,
                    'deskripsi' => 'Data tidak ditemukan'
                ]
            ],404);
        } 
        return (new TransactionResource($tra))->additional([
            'status' => [
                'code' => 200,
                'description' => 'Ok!'
            ]
        ])->response()->setStatusCode(200);
    }

    public function byUser($iduser, $status=null)
    {
        // return Response::json($iduser);
        $query = Transaction::with('userRelation')
        ->where('user_id', $iduser);

        if ($status != null) {
            if ($status == 'unpaid') {
                $query->whereIn('status_transaksi', ['menunggu','tertunda']);
            }elseif( $status = 'paid' ){
                $query->whereIn('status_transaksi',['diproses','dikirim']);
            }
        }

        $tr = $query->paginate(10);

        // return $tr;
        if ($tr->isEmpty()) {
            return Response::json([
                'status' => [
                    'code'  => 404,
                    'description'   => 'Data tidak ditemukan!',
                ]
            ], 404);
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


    public function upload(Request $request, $code)
    {
        $tra = Transaction::where('kode_transaksi',$code)->first();

        if ($tra == null) {
            return Response::json([
                'status'    => [
                    'code'      => 404,
                    'deskripsi' => 'Data tidak ditemukan'
                ]
            ], 404);
        }

        if ( ! $request->hasFile('bukti') ) {
            return Response::json([
                "status" => [
                    "code" => 403,
                    "description" => "Bad Request",
                ]
            ],403);
        }
        $path = $request->file('bukti')->store('transaksi');

        $tra->update([
            'prof_of_payment'   => $path,
            'status_transaksi'   => 'tertunda',
        ]);

        return Response::json([
            'status'    => [
                'code'      => 202,
                'deskripsi' => 'Update diterima!'
            ]
        ], 202);
    }
}

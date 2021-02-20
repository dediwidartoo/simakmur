<?php

namespace App\Http\Controllers\Web;

use DB;
use Response;
use Storage;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $produks = Product::orderBy('produk','asc')->paginate(10);
        return view('admin.product.index', compact('produks'));
    }

    public function show($id)
    {
        $produks = Product::with('imageRelation')->where('id', $id)->first();
        // dd($produks);
        return view('admin.product.detailproduk',compact('produks'));
    }

    public function toko(Request $request)
    {
        $request->validate([
            'produk'    => 'required|max:60',
            'harga'     => 'required|min:0',
            'stok'      => 'required|min:0',
            'images.*'  => 'required|mimes:jpg,jpeg,png',

        ]);
        // dd ($request->all());
        DB::beginTransaction();

        try {
            $produk = Product::create([
                'produk'    => $request->produk,
                'harga'     => $request->harga,
                'stok'      => $request->stok,
                'deskripsi' => $request->deskripsi,
            ]);

            if ($request->hasFile('images')) {
                
                $array = [];

                foreach ($request->images as $key => $value) {
                    $path = $value->store('produk');

                    $image = [
                        'produk_id' => $produk->id,
                        'gambar'    => $path,
                    ];

                    array_push($array, $image);

                }
                ImageProduct::insert($array);
            }
            

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

            dd($e);
        }

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $produk = Product::where('id',$request->id)->first();
        $gambarProdukLama = ImageProduct::where('produk_id',$request->id)->get();

        DB::beginTransaction();

        try {
            $produk->update([
                'produk'    => $request->produk,
                'harga'     => $request->harga,
                'stok'      => $request->stok,
                'deskripsi' => $request->deskripsi,
            ]);


            if ($request->hasFile('images')) {
                if (count($gambarProdukLama) >= 0) {
                    foreach ($gambarProdukLama as $lama) {
                        Storage::delete($lama->image);
                    }
                    ImageProduct::where('produk_id',$request->id)->delete();
                }

                $array = [];

                foreach ($request->images as $key => $value) {
                    $path = $value->store('produk');

                    $image = [
                        'produk_id' => $request->id,
                        'gambar'    => $path,
                    ];

                    array_push($array, $image);

                }
                ImageProduct::insert($array);
            }

            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }

        return redirect()->back();

    }
}

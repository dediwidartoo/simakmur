<?php

namespace App\Http\Controllers\Web;

use DB;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ImageProduct;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $produks = Product::latest()->paginate(10);
        return view('admin.master.product.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.master.product.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * 
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // $request->validate([
        //     'produk'    => 'required|max:60',
        //     'harga'     => 'required|min:0',
        //     'stok'      => 'required|min:0',
        //     'images.*'  => 'required|mimes:jpg,jpeg,png',
        // ]);

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
                
                $arrayImages = [];

                foreach ($request->images as $key => $value) {
                    $path = $value->store('produk');

                    $image = [
                        'produk_id' => $produk->id,
                        'gambar'    => $path,
                    ];

                    array_push($arrayImages, $image);

                }
                ImageProduct::insert($arrayImages);
            }
            

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $produks = Product::with('imageRelation')->where('id', $id)->first();
        $produks = Product::with(['imageRelation'])->find($id);
        // dd($produks);
        return view('admin.master.product.detail',compact('produks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.master.product.edit', compact('product'));
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
        // $produk = Product::where('id',$request->id)->first();
        $product = Product::find($id);
        // $gambarProdukLama = ImageProduct::where('produk_id',$request->id)->get();
        $gambarProdukLama = ImageProduct::where('produk_id',$id)->get();

        DB::beginTransaction();

        try {
            $product->update([
                'produk'    => $request->produk,
                'harga'     => $request->harga,
                'stok'      => $request->stok,
                'deskripsi' => $request->deskripsi,
            ]);


            if ($request->hasFile('images')) {
                if (count($gambarProdukLama) >= 0) {
                    foreach ($gambarProdukLama as $lama) {
                        Storage::delete($lama->gambar);
                    }
                    ImageProduct::where('produk_id',$id)->delete();
                }

                $arrayImages = [];

                foreach ($request->images as $value) {
                    $path = $value->store('produk');

                    $image = [
                        'produk_id' => $product->id,
                        'gambar'    => $path,
                    ];

                    array_push($arrayImages, $image);

                }
                ImageProduct::insert($arrayImages);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->route("product.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if( !$product ){
            abort(404);
        }

        $oldImages = ImageProduct::where('produk_id',$id)->get();

        if( count( $oldImages ) >= 0 ){

            foreach ($oldImages as $old) {
                Storage::delete($old->gambar);
            }

            ImageProduct::where('produk_id',$id)->delete();
        }

        $product->delete();

        return redirect()->route("product.index");
    }
}

<?php

namespace App\Http\Controllers\Api;

use DB;
use Response;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\ImageProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProdukController extends Controller
{
    public function produk(Request $request)
    {
        // $singleImage = DB::raw("(select coalesce(gambar,null) from images_product 
        // where products.id = images_product.produk_id order by images_product.id desc limit 1) as image");

        // $query = Product::select('*',$singleImage);

        $query = Product::with(['latestImage'])
        ->select('*')->orderBy('produk','asc');

        if($request->search != null){
            $query->where('produk','like','%'.$request->search.'%');
        }
        
        // $query->orderBy('produk');
        $products = $query->paginate(10);

        if ($products->isEmpty()) {
            return Response::json([
                'status' => [
                    'code'  => 404,
                    'description'   => 'Data tidak ditemukan!',
                ]
                ], 404);
        } else{
            // return $products;
            return ProductResource::collection($products)->additional([
                'status' => [
                    'code'  => 200,
                    'description'   => 'Ok!',
                ]
            ])->response()->setStatusCode(200);
        }
    }

    public function product($id)
    {
        $product = Product::with('imageRelation')->where('id',$id)->first();
        if ($product == null) {
            return Response::json([
                'status' => [
                    'code'  => 404,
                    'description'   => 'Data tidak ditemukan!',
                ]
                ], 404);
        } else{
            return (new ProductResource($product))->additional([
                'status' => [
                    'code' => 200,
                    'description' => 'Ok!'
                ]
            ])->response()->setStatusCode(200);
        }
    }
}

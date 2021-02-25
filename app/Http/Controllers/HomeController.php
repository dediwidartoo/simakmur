<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaction = Transaction::whereMonth('created_at',Carbon::now()->format('m'))->count();
        $productSale = DetailTransaction::whereMonth('created_at',Carbon::now()->format('m'))->sum('jumlah_barang');
        $customer = User::where('is_admin',false)->count();
        $products = Product::count();

        // dd($productSale,$transaction,$customer,$products);

        return view('admin.dashboard', compact('transaction','productSale','customer','products'));
    }
}

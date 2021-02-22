<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            array('produk' => 'hoodie','harga' => '300000.00','stok' => '99100','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Sepatu Ripcurl','harga' => '120000.00','stok' => '99100','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Jaket Eiger','harga' => '160000.00','stok' => '99100','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Kerudung','harga' => '600000.00','stok' => '99100','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Supreme','harga' => '120000.00','stok' => '99100','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Celana Joger adida','harga' => '120000.00','stok' => '9920','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Jam Tangan','harga' => '160000.00','stok' => '99100','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Tas Eiger','harga' => '320000.00','stok' => '9960','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Baju koko','harga' => '110000.00','stok' => '99120','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Kerudung rawis','harga' => '90000.00','stok' => '9960','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Celana Jeans','harga' => '170000.00','stok' => '9990','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('produk' => 'Celana pendek joger','harga' => '90000.00','stok' => '99120','deskripsi' => NULL,'created_at' => \Carbon\Carbon::now())
        );

        Product::insert($products);
    }
}

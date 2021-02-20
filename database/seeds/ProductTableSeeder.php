<?php

use App\Models\Product;
use App\Models\ImageProduct;
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

        $images_product = array(
            array('produk_id' => '1','gambar' => 'produk/mdaKIF8GJq27VOQYL3A85y3hQ8LgaaLvymwxYMIN.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '2','gambar' => 'produk/TwLz3X3WqkF98xqK9S8qqCyoLMoie5syAs42MaZA.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '2','gambar' => 'produk/M2DR4K6wRgohHucUNusc35nJtzIgKWpMa5T5Im9D.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '3','gambar' => 'produk/3geeJdlbZP3zMlEH2SNrdUkIZctjJDnBaoANn1SQ.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '3','gambar' => 'produk/yvDoyeBHWrGwiqQNpu0PoJEmPwIfQxEgJFSX4uPR.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '3','gambar' => 'produk/1ldLllCe07BQaje8mdITDyJvdNOR39WWvOyF8OYR.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '4','gambar' => 'produk/SU3SXhvZ3vSEjBBtLhJorJXX6If1Jju7qa4ndnau.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '4','gambar' => 'produk/AAHunxoX1e22Z0anbmkKdiwMGJBBFpkX7cHHCqGp.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '4','gambar' => 'produk/lhBeyaX4iY4Os49eZcCPDZst01eaAtKYmlf9EnyM.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '4','gambar' => 'produk/bJj8pRmts8O4OHkXUvH0d8U6IK3uLgvUwAUc0B0w.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '5','gambar' => 'produk/BMnxJUQjNN5FkbPZtVA6zYsr9wipnODRCbSGPeBm.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '5','gambar' => 'produk/FIsEbTcELOy33GrUfCgmUAtqEAL5DTbKXAYSISZF.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '6','gambar' => 'produk/JTeoIVUwYorwJjiqlAe80pOFjqfmQ2IRRE050kSB.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '6','gambar' => 'produk/Vnf74FSKZPrgKZzu4CFZOvoFu00b4UIRr6x6SQq3.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '6','gambar' => 'produk/3vKUjYg0ZIkTjlNmJvSvfZzy5EdFYcppmgrHE4gr.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '7','gambar' => 'produk/wJMubHan2j36rVuACrnDydh9Ybj8CyCeywf76WUq.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '7','gambar' => 'produk/mFDhD65SmPRoaWRELJUmAgP91eolmZTns1uHPwNd.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '7','gambar' => 'produk/wiFQ80tHQMtzxQ9yo2IRbdlo7LGyiQ4U60jlxIju.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '8','gambar' => 'produk/6GigSOsX2FHqP36EvrCZigU5GkLbpMAiWiUiRwgr.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '8','gambar' => 'produk/DcCDT6FuquF0J3HnWxjcCxDV5CAduGNqfXimyELU.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '8','gambar' => 'produk/NEI7PqiV5gCyQx7d8D13EfRX6KMtFo5pQDN9WlPs.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '9','gambar' => 'produk/vIuWv22rM1ZMmS5zCq91FMzoXk99WGG44x1zoZUe.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '9','gambar' => 'produk/2UeCIQMQSEL3CduAX4S2qJccUpocoIwr36b2NxQ1.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '9','gambar' => 'produk/BiSOmkNbYMGsUncpkF9FhyJjM9yrvzy4dlurdWRr.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '10','gambar' => 'produk/jEkfStAzxaXwYQEVrHwKAUI5NUEaz7OHIlGQPPFl.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '10','gambar' => 'produk/LKUdDHCabsww70H9MuIeRKhnAkgb9IJZnWIknwXJ.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '10','gambar' => 'produk/KSr2FC51xNXC3VJxxm6J4soW4TK9crC95pG97sVX.png','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '11','gambar' => 'produk/oIPVv7Vq8FOVVRRQg8XOO8bnPzv3euM1VPQpoQ6G.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '11','gambar' => 'produk/2ud1EZT5kI0jlEfos8GP7kXjDlqb1aGNtq3LRM94.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '11','gambar' => 'produk/hNbGDRnIHQcoNIMoKnYjoE2MHXDHWR5wmP7rfls0.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '12','gambar' => 'produk/UNuYWCOoBz0TNkDw90bz3JYw6PVfH4OUbXoQNIDK.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '12','gambar' => 'produk/tX0U1caW83Bt05oaif96QN3dRtxdnMaqtJE9vvRh.jpeg','created_at' => \Carbon\Carbon::now()),
            array('produk_id' => '12','gambar' => 'produk/SsgJ9Tvy961vqdnA38uygadAhv2JEi4uNTHRmnar.jpeg','created_at' => \Carbon\Carbon::now())
        );

        ImageProduct::insert($images_product);
    }
}

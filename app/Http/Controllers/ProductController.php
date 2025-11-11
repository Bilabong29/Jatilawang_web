<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            ['slug' => 'sepatu-gunung-eiger', 'name' => 'Sepatu Gunung Eiger Anaconda 2.5', 'price' => 'Rp 1.399.000', 'img' => 'https://via.placeholder.com/400x400?text=Sepatu+Gunung', 'desc' => 'Sepatu hiking dengan bahan tahan air dan sol anti slip untuk medan berat.'],
            ['slug' => 'tenda-camping-anterlaser', 'name' => 'Tenda Camping Anterlaser (2 Orang)', 'price' => 'Rp 750.000', 'img' => 'https://via.placeholder.com/400x400?text=Tenda', 'desc' => 'Tenda ringan dengan ventilasi udara ganda dan kapasitas 2 orang.'],
            ['slug' => 'jaket-gunung-waterproof', 'name' => 'Jaket Gunung Waterproof', 'price' => 'Rp 125.500', 'img' => 'https://via.placeholder.com/400x400?text=Jaket', 'desc' => 'Jaket tahan air dan angin, ideal untuk pendakian dan perjalanan outdoor.'],
            ['slug' => 'sleeping-bag-adventure', 'name' => 'Sleeping Bag Adventure', 'price' => 'Rp 861.150', 'img' => 'https://via.placeholder.com/400x400?text=Sleeping+Bag', 'desc' => 'Sleeping bag dengan bahan halus dan lapisan hangat untuk suhu dingin.'],
        ];

        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        // Pakai daftar NAMA yang SAMA persis seperti di index.blade.php
        $products = [
            ['name'=>'Sepatu Gunung Eiger Anaconda 2.5','price'=>'Rp 1.399.000','img'=>'https://via.placeholder.com/600x600?text=Sepatu+Gunung','desc'=>'Sepatu hiking dengan bahan tahan air dan sol anti slip untuk medan berat.'],
            ['name'=>'Tenda Camping Anterlaser (2 Orang)','price'=>'Rp 750.000','img'=>'https://via.placeholder.com/600x600?text=Tenda','desc'=>'Tenda ringan dengan ventilasi udara ganda dan kapasitas 2 orang.'],
            ['name'=>'Jaket Gunung Waterproof','price'=>'Rp 125.500','img'=>'https://via.placeholder.com/600x600?text=Jaket','desc'=>'Jaket tahan air dan angin, ideal untuk pendakian dan perjalanan outdoor.'],
            ['name'=>'Sleeping Bag Adventure','price'=>'Rp 861.150','img'=>'https://via.placeholder.com/600x600?text=Sleeping+Bag','desc'=>'Sleeping bag hangat untuk malam dingin.'],
            ['name'=>'Carrier Eiger Streamline 45L','price'=>'Rp 849.000','img'=>'https://via.placeholder.com/600x600?text=Tas+Gunung','desc'=>'Carrier 45L nyaman untuk trekking menengah.'],
            ['name'=>'Headlamp Sunrei MUYE 3','price'=>'Rp 750.000','img'=>'https://via.placeholder.com/600x600?text=Headlamp','desc'=>'Headlamp terang dan hemat daya untuk malam hari.'],
            ['name'=>'Celana Gunung Cargo Outdoor','price'=>'Rp 185.000','img'=>'https://via.placeholder.com/600x600?text=Celana+Outdoor','desc'=>'Celana outdoor ringan, cepat kering, banyak kantong.'],
            ['name'=>'Botol Minum Adventure 1L','price'=>'Rp 152.000','img'=>'https://via.placeholder.com/600x600?text=Botol+Minum','desc'=>'Botol 1L tahan banting, cocok untuk hiking harian.'],
        ];

        // Cari produk dgn slug nama yang cocok
        $product = collect($products)->first(function ($p) use ($slug) {
            return Str::slug($p['name']) === $slug;
        });

        if (!$product) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }

}

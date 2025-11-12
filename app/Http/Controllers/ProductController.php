<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua produk dari database
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        // Mengambil satu produk berdasarkan slug, jika tidak ada -> 404
        $product = Product::where('slug', $slug)->firstOrFail();

        // Mengambil produk terkait (opsional, ambil 4 produk acak selain produk ini)
        $relatedProducts = Product::where('id', '!=', $product->id)
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
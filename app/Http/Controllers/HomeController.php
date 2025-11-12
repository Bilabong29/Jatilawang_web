<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- Import Model Product
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua produk dari database
        // Asumsi nama model adalah 'Product' dan sudah ada
        $products = Product::all();

        return view('home', [
            // Mengirim data produk ke view
            'products' => $products,
        ]);
    }
}
<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // Jika kamu mau, ambil beberapa produk untuk ditampilkan di hero/section awal
        // $featured = Product::latest()->take(8)->get();
        return view('home'); // buat resources/views/home.blade.php
    }
}

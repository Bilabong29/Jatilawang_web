<?php

namespace App\Http\Controllers;

use App\Models\Item; // Gunakan Item sebagai sumber katalog utama
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua item dari database (sesuai ERD laporan)
        $items = Item::all();

        return view('home', [
            // Kirim data item ke view home
            'items' => $items,
        ]);
    }
}
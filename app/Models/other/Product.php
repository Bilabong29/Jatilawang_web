<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi (sesuai tabel database Anda)
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image_url',
        // 'category_id', // Aktifkan jika nanti pakai kategori
    ];

    // Jika nama tabel di database bukan 'products', definisikan di sini:
    // protected $table = 'products';
}
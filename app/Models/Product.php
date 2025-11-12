<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image', // Diganti dari 'image_url' agar sesuai dengan home.blade.php
        'stock',
        'is_favorite', // Ditambahkan agar sesuai dengan home.blade.php
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'is_favorite' => 'boolean', // Penting untuk mengontrol Icon Love di view
    ];

    // auto-generate slug jika belum diisi
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                // Menambahkan random string hanya jika slug sudah ada, 
                // tapi kita buat sederhana dulu.
            }
        });
        
        // Memastikan slug diperbarui jika nama berubah
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                 $product->slug = Str::slug($product->name);
            }
        });
    }

    // Helper untuk memformat harga (Dipanggil dengan $product->price_formatted)
    public function getPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // CATATAN: Method 'show' harus berada di Controller, bukan di Model.
    // Logic untuk menampilkan view dipindahkan ke ProductController.
}
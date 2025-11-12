<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','description','price','image_url','stock'
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    // auto-generate slug jika belum diisi
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(6);
            }
        });
    }

    // opsional helper
    public function getPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function show(Product $product)
    {
    // $product otomatis terisi berdasarkan slug
    return view('shop.show', compact('product'));
    }

}

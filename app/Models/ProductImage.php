<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;
    
    // Non-default table name for clarity
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'filename',    // Nama file gambar
        'is_featured',  // true jika ini adalah gambar utama/cover
        'sort_order',   // Untuk urutan penampilan gambar di galeri
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Tentukan relasi many-to-one ke Product.
     * Satu Gambar dimiliki oleh satu Produk.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
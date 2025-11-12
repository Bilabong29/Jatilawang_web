<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Tentukan relasi one-to-many ke Product.
     * Sebuah Kategori memiliki banyak Produk.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Auto-generate slug jika belum diisi
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                 $category->slug = Str::slug($category->name);
            }
        });
    }

    // Ubah pencarian default Route Model Binding menjadi menggunakan slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
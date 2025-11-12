<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'item_id';
    public $incrementing = false; 
    protected $keyType = 'int';

    protected $fillable = [
        'item_name', 'description', 'category', 'url_image',
        'rental_price_per_day', 'sale_price', 'rental_stock',
        'sale_stock', 'penalty_per_days', 'is_rentable', 'is_sellable'
    ];

    protected $casts = [
        'is_rentable' => 'boolean',
        'is_sellable' => 'boolean',
    ];

    // Relasi
    public function rentalDetails()
    {
        return $this->hasMany(DetailRental::class, 'item_id', 'item_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(DetailBuy::class, 'item_id', 'item_id');
    }

    public function detailRent()
    {
        return $this->hasOne(ItemDetailRent::class, 'item_id', 'item_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'item_id', 'item_id');
    }

    // Relasi many-to-many via pivot
    public function rentals()
    {
        return $this->belongsToMany(Rental::class, 'detail_rentals', 'item_id', 'rental_id')
                    ->withPivot('quantity', 'penalty');
    }

    public function orders()
    {
        return $this->belongsToMany(Buy::class, 'detail_orders', 'item_id', 'order_id')
                    ->withPivot('quantity', 'total_price');
    }
}
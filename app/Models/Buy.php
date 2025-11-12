<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $primaryKey = 'order_id';
    public $incrementing = true;

    protected $fillable = [
        'user_id', 'total_price', 'shipping_address'
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(DetailBuy::class, 'order_id', 'order_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'detail_orders', 'order_id', 'item_id')
                    ->withPivot('quantity', 'total_price');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'buy_id', 'order_id');
    }
}
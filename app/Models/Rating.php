<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'rating_id';

    protected $fillable = [
        'user_id', 'item_id', 'rental_id', 'buy_id',
        'rating_value', 'comment'
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id', 'rental_id');
    }

    public function order()
    {
        return $this->belongsTo(Buy::class, 'buy_id', 'order_id');
    }
}
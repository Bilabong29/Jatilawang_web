<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBuy extends Model
{
    protected $primaryKey = 'order_detail_id';
    public $table = 'detail_orders';

    protected $fillable = ['order_id', 'item_id', 'quantity', 'total_price'];

    // Relasi
    public function order()
    {
        return $this->belongsTo(Buy::class, 'order_id', 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDetailRent extends Model

{
    public $table = 'item_detail_rent';
    protected $primaryKey = 'rent_detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'rent_detail_id',
        'item_id',
        'status',
        'note',
        'current_rental_id'
    ];

    // Relasi
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function currentRental()
    {
        return $this->belongsTo(Rental::class, 'current_rental_id', 'rental_id');
    }
}

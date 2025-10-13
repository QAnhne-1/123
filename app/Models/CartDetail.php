<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cart_detail';
    public $fillable = [
        'cart_id',
        'variant_id',
        'quantity',
        'price_at_time'
    ];

    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    public function variant() {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}

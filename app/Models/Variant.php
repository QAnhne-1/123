<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'variants';
    public $fillable = [
        'product_id',
        'quantity',
        'price',
        'color',
        'image',
        'price_khuyen_mai',
        'start_date',
        'end_date',
        'status'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function cartDetail() {
        return $this->hasMany(CartDetail::class, 'variant_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_country_id',
        'product_id'
    ];

    public function product() {
        //Relación con el producto
        return $this->belongsTo(Product::class);
    }
}

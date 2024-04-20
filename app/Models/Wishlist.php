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

    public function scopeCountry($query, int $catalog_country_id) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalog_country_id);
    }
}

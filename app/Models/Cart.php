<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_country_id',
        'product_id',
        'quantity'
    ];

    public function product() {
        //Relación con el producto
        return $this->belongsTo(Product::class);
    }

    public function scopeCatalogCountryId($query, int $catalogCountryId) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalogCountryId);
    }
}

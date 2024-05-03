<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogPaymentMethod extends Model
{
    use HasFactory;

    public function scopeCatalogCountryId($query, int $catalogCountryId) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalogCountryId);
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

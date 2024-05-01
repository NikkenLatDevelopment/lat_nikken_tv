<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    public function scopeCountry($query, int $catalog_country_id) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalog_country_id);
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

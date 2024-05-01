<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    public function scopeSearch($query, string $search) {
        //Filtrar por búsqueda
        return $query->where(function($query) use ($search) {
            empty($search)
            ? null
            : $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('cellular', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('complement_address', 'like', '%' . $search . '%')
                    ->orWhere('reference_address', 'like', '%' . $search . '%')
                    ->orWhere('state', 'like', '%' . $search . '%')
                    ->orWhere('municipality', 'like', '%' . $search . '%')
                    ->orWhere('colony', 'like', '%' . $search . '%')
                    ->orWhere('postal_code', 'like', '%' . $search . '%');
        });
    }

    public function scopeCountry($query, int $catalog_country_id) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalog_country_id);
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

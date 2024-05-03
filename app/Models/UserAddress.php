<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_country_id',
        'name',
        'email',
        'phone',
        'cellphone',
        'address',
        'complement_address',
        'reference_address',
        'state',
        'state_code',
        'municipality',
        'municipality_code',
        'colony',
        'colony_code',
        'postal_code',
        'status'
    ];

    public function scopeSearch($query, string $search) {
        //Filtrar por búsqueda
        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('cellphone', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%")
                  ->orWhere('complement_address', 'like', "%$search%")
                  ->orWhere('reference_address', 'like', "%$search%")
                  ->orWhere('state', 'like', "%$search%")
                  ->orWhere('municipality', 'like', "%$search%")
                  ->orWhere('colony', 'like', "%$search%")
                  ->orWhere('postal_code', 'like', "%$search%");
        });
    }

    public function scopeCatalogCountryId($query, int $catalogCountryId) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalogCountryId);
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

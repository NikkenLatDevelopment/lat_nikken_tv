<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public function campaignProducts() {
        //Relación con los productos de la campaña
        return $this->hasMany(CampaignProduct::class);
    }

    public function campaignUserTypes() {
        //Relación con los tipos de usuario de la campaña
        return $this->hasMany(CampaignUserType::class);
    }

    public function scopeActive($query, int $catalog_country_id) {
        //Filtrar por país, vigencia y estatus
        return $query->country($catalog_country_id)
                     ->valid()
                     ->status();
    }

    public function scopeCountry($query, int $catalog_country_id) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalog_country_id);
    }

    public function scopeValid($query) {
        //Filtrar por vigencia
        return $query->where(function ($query) {
            //Filtrar por vigencia
            $query->where(function ($query) {
                //Sin fecha de vigencia
                $query->whereNull('valid_from')
                      ->whereNull('valid_to');
            })->orWhere(function ($query) {
                //Con fecha de vigencia
                $query->where('valid_from', '<=', now())
                      ->whereNull('valid_to');
            })->orWhere(function ($query) {
                //Con fechas de vigencia
                $query->where('valid_from', '<=', now())
                      ->where('valid_to', '>=', now());
            });
        });
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

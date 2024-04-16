<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function catalogProductBrand() {
        //Relación con el catálogo de marcas de los productos
        return $this->belongsTo(CatalogProductBrand::class);
    }

    public function CampaignProducts() {
        //Relación con los productos de la campaña
        return $this->hasMany(CampaignProduct::class);
    }

    public function scopeActive($query, int $catalog_country_id, ?string $brandSlug = null) {
        //Filtrar por marca, país, campaña, vigencia, si se puede comprar, si está descontinuado, visibilidad y estatus
        return $query->brand($brandSlug)
                     ->country($catalog_country_id)
                     ->campaign($catalog_country_id)
                     ->valid()
                     ->purchasable()
                     ->discontinued()
                     ->visible()
                     ->status();
    }

    public function scopeBrand($query, ?string $slug = null) {
        //Relación con el catálogo de marcas
        return $query->where(function ($query) use ($slug) {
            //Relación con el catálogo de marcas
            return $query->whereHas('catalogProductBrand', function ($query) use ($slug) {
                //Filtrar por marca y estatus
                $query->when($slug != null, function ($query) use ($slug) {
                    //Filtrar por marca
                    $query->where('slug', $slug);
                    //Filtrar por estatus
                })->status();
            });
        });
    }

    public function scopeCountry($query, int $catalog_country_id) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalog_country_id);
    }

    public function scopeCampaign($query, int $catalog_country_id) {
        //Filtrar por campaña
        return $query->where(function ($query) use ($catalog_country_id) {
            //Filtrar por los productos de la campaña
            $query->whereHas('campaignProducts', function ($query) use ($catalog_country_id) {
                //Filtrar por campaña
                $query->whereHas('campaign', function ($query) use ($catalog_country_id) {
                    //Filtrar por campañas activas
                    $query->active($catalog_country_id)
                          ->whereHas('campaignUserTypes.catalogUserType', function ($query) {
                            //Filtrar por tipo de usuario
                            $query->when(auth()->check(), function ($query) {
                                //Filtrar por usuario autenticado
                                $query->where('id', auth()->user()->catalog_user_type_id);
                            }, function ($query) {
                                //Filtrar por usuario no autenticado
                                $query->where('id', 1);
                            })->status();
                          });
                });
            })->orWhereDoesntHave('campaignProducts');
        });
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

    public function scopePurchasable($query) {
        //Filtrar si se puede comprar
        return $query->where('is_purchasable', 1);
    }

    public function scopeDiscontinued($query) {
        //Filtrar si está descontinuado
        return $query->where('is_discontinued', 0);
    }

    public function scopeVisible($query) {
        //Filtrar por la visibilidad
        return $query->where('is_visible', 1);
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

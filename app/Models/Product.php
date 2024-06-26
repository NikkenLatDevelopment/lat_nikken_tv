<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function productComponents() {
        //Relación con los componentes del producto
        return $this->hasMany(ProductComponent::class, 'parent_product_id');
    }

    public function productColors() {
        //Relación con los colores del producto
        return $this->hasMany(ProductColor::class, 'parent_product_id');
    }

    public function productPresentations() {
        //Relación con las presentaciones del producto
        return $this->hasMany(ProductPresentation::class, 'parent_product_id');
    }

    public function productMeasurements() {
        //Relación con las medidas del producto
        return $this->hasMany(ProductMeasurement::class, 'parent_product_id');
    }

    public function productTags() {
        //Relación con los tags del producto
        return $this->hasMany(ProductTag::class);
    }

    public function catalogProductBrand() {
        //Relación con el catálogo de marcas de los productos
        return $this->belongsTo(CatalogProductBrand::class);
    }

    public function campaignProducts() {
        //Relación con los productos de la campaña
        return $this->hasMany(CampaignProduct::class);
    }

    public function scopeBasicData() {
        //Obtener información necesaria para mostrar el producto
        return $this->select('id', 'catalog_product_brand_id', 'sku', 'slug', 'name', 'short_description', 'description', 'differentiators', 'maintenance', 'image', 'video', 'suggested_price', 'vat_suggested_price', 'points', 'vc', 'retail', 'stock', 'stock_applies', 'warranty', 'rating_total', 'available_until', 'parent_product_id');
    }

    public function scopeAvailabilityData() {
        //Obtener información necesaria para mostrar la disponibilidad del producto
        return $this->select('id', 'sku', 'name', 'stock', 'stock_applies', 'available_until');
    }

    public function scopeActive($query, int $catalogCountryId, ?string $catalogProductBrandSlug = null) {
        //Filtrar por marca, país, campaña, vigencia, si se puede comprar, si está descontinuado, visibilidad y estatus
        return $query->catalogProductBrand($catalogProductBrandSlug)
                     ->catalogCountryId($catalogCountryId)
                     ->campaign($catalogCountryId)
                     ->valid()
                     ->isPurchasable()
                     ->isDiscontinued()
                     ->isVisible()
                     ->status();
    }

    public function scopeCatalogProductBrand($query, ?string $catalogProductBrandSlug = null) {
        //Relación con el catálogo de marcas
        return $query->where(function ($query) use ($catalogProductBrandSlug) {
            //Relación con el catálogo de marcas
            return $query->whereHas('catalogProductBrand', function ($query) use ($catalogProductBrandSlug) {
                //Filtrar por marca y estatus
                $query->when($catalogProductBrandSlug != null, fn ($query) => $query->where('slug', $catalogProductBrandSlug))
                      ->status();
            });
        });
    }

    public function scopeCatalogCountryId($query, int $catalogCountryId) {
        //Filtrar por país
        return $query->where('catalog_country_id', $catalogCountryId);
    }

    public function scopeCampaign($query, int $catalogCountryId) {
        //Filtrar por campaña
        return $query->where(function ($query) use ($catalogCountryId) {
            //Filtrar por los productos de la campaña
            $query->whereHas('campaignProducts', function ($query) use ($catalogCountryId) {
                //Filtrar por campaña
                $query->whereHas('campaign', function ($query) use ($catalogCountryId) {
                    //Filtrar por campañas activas
                    $query->active($catalogCountryId)
                          ->whereHas('campaignUserTypes.catalogUserType', function ($query) {
                            $query->when(
                                auth()->check(),
                                fn ($query) => $query->where('id', auth()->user()->catalog_user_type_id),
                                fn ($query) => $query->where('id', 1)
                            )->status();
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

    public function scopeIsPurchasable($query) {
        //Filtrar si se puede comprar
        return $query->where('is_purchasable', 1);
    }

    public function scopeIsDiscontinued($query) {
        //Filtrar si está descontinuado
        return $query->where('is_discontinued', 0);
    }

    public function scopeIsVisible($query) {
        //Filtrar por la visibilidad
        return $query->where('is_visible', 1);
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }

    public function getAvailability(array $components) {
        $available = 1;
        $componentsAvailable = [];
        $componentsNotAvailable = [];

        if (!empty($components)) {
            foreach ($components as $component) {
                //Verificar inventario de los componentes
                if ($component['product']['stock'] <= 0 && $component['product']['stock_applies'] == 1) {
                    //Marcar producto en entrega postergada
                    $available = 0;

                    //Guardar componentes con entrega postergada
                    $componentsNotAvailable[] = [
                        'sku' => $component['product']['sku'],
                        'name' => $component['product']['name'],
                        'date' => $component['product']['available_until'] == null
                            ? 'Sin fecha estimada de disponibilidad'
                            : formatDateInSpanishLocale($component['product']['available_until']),
                    ];
                } else {
                    //Guardar componentes disponibles
                    $componentsAvailable[] = [
                        'sku' => $component['product']['sku'],
                        'name' => $component['product']['name'],
                    ];
                }
            }
        } else {
            //Verificar inventario del producto
            if ($this->stock <= 0 && $this->stock_applies == 1) {
                //Marcar producto en entrega postergada
                $available = 0;
            }
        }

        return [
            'available' => $available,
            'componentsAvailable' => $componentsAvailable,
            'componentsNotAvailable' => $componentsNotAvailable
        ];
    }
}

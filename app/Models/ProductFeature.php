<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;

    public function catalogProductFeature() {
        //Relacionar con el catálogo de características del producto
        return $this->belongsTo(CatalogProductFeature::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTechnology extends Model
{
    use HasFactory;

    public function catalogProductTechnology() {
        //Relacionar con el catálogo de tecnologías del producto
        return $this->belongsTo(CatalogProductTechnology::class);
    }
}

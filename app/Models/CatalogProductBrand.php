<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogProductBrand extends Model
{
    use HasFactory;

    public function scopeStatus($query, ?int $view = 0) {
        //Filtrar por estatus y omitir sin marca
        return $query->when($view == 0, fn ($query) => $query->where('id', '>', 1))
                     ->where('status', 1);
    }

    public function products() {
        //Relación con los productos
        return $this->hasMany(Product::class);
    }
}

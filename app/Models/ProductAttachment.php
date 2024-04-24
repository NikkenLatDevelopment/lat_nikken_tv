<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    use HasFactory;

    public function catalogProductAttachment() {
        //Relacionar con el catálogo de adjuntos del producto
        return $this->belongsTo(CatalogProductAttachment::class);
    }
}

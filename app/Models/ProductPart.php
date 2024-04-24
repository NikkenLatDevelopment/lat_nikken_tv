<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPart extends Model
{
    use HasFactory;

    public function product() {
        //Relación con el producto
        return $this->belongsTo(Product::class);
    }
}

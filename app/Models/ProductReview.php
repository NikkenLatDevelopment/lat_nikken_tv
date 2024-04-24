<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    public function user() {
        //Relación con el usuario
        return $this->belongsTo(User::class);
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 2);
    }
}

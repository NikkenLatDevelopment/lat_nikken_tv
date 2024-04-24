<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomStore extends Model
{
    use HasFactory;

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

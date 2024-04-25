<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'comment',
        'rating'
    ];

    public function user() {
        //Relación con el usuario
        return $this->belongsTo(User::class);
    }

    public function scopeStatus($query, int $status = 2) {
        //Filtrar por estatus
        return $query->where('status', $status);
    }
}

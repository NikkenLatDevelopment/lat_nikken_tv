<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignProduct extends Model
{
    use HasFactory;

    public function product() {
        //Relación con el producto
        return $this->belongsTo(Product::class);
    }

    public function campaign() {
        //Relación con la campaña
        return $this->belongsTo(Campaign::class);
    }
}

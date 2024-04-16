<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignUserType extends Model
{
    use HasFactory;

    public function catalogUserType() {
        //Relación con el tipo de usuario
        return $this->belongsTo(CatalogUserType::class);
    }
}

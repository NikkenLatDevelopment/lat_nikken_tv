<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogCountry extends Model
{
    use HasFactory;

    public function scopeSessionData() {
        //Obtener información necesaria para la sesión
        return $this->select('id', 'code', 'name', 'vat', 'currency_symbol', 'currency_decimal');
    }

    public function scopeClosed($query) {
        //Filtrar por las fechas de cierre
        return $query->where(function ($query) {
            //Filtrar por las fechas de cierre
            $query->where(function ($query) {
                //Sin fecha de cierre
                $query->whereNull('closed_from')
                      ->whereNull('closed_to');
            })->orWhere(function ($query) {
                //Con fecha de cierre
                $query->where('closed_from', '<=', now())
                      ->where('closed_to', '<=', now());
            });
        });
    }

    public function scopeStatus($query) {
        //Filtrar por estatus
        return $query->where('status', 1);
    }
}

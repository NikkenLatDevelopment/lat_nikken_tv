<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_country_id',
        'catalog_price_list_id',
        'subtotal',
        'discount',
        'iva',
        'total'
    ];

    public function saleProducts() {
        //Relación con los productos de la venta
        return $this->hasMany(SaleProduct::class);
    }

    public function saleAddress() {
        //Relación con la dirección de la venta
        return $this->hasOne(SaleAddress::class);
    }

    public function salePayment() {
        //Relación con el pago de la venta
        return $this->hasMany(SalePayment::class);
    }
}

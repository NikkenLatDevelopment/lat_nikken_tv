<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function catalogCountry() {
        //Relación con el país
        return $this->belongsTo(CatalogCountry::class);
    }

    public function wishlists() {
        //Relación con la lista de deseos
        return $this->hasMany(Wishlist::class);
    }

    public function cart() {
        //Relación con el carrito de compras
        return $this->hasMany(Cart::class);
    }

    public function customStore() {
        //Relación con la tienda personalizada
        return $this->hasOne(CustomStore::class);
    }

    public function productReviews() {
        //Relación con los reviews de los productos
        return $this->hasMany(ProductReview::class);
    }
}

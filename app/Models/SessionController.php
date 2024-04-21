<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Cookie;

class SessionController
{
    protected $session;

    public function __construct(SessionManager $session) {
        //Iniciar sesión
        $this->session = $session;
    }

    public function setCountry(array $catalogCountry): void {
        //Generar objeto
        $country = SessionControllerCountry::toObject($catalogCountry);

        //Guardar sesión
        $this->session->put("country", $country->toArray());

        //Guardar cookie
        Cookie::queue('country_id', $country->id);
    }

    public function getCountry(): ?object {
        //Obtener información
        $country = $this->session->get('country');

        //Generar objeto
        return $country ? SessionControllerCountry::toObject($country) : null;
    }

    public function getCountryId(): ?int {
        //Obtener ID del país por sesión
        $countryId = $this->session->get('country.id');

        if (empty($countryId)) {
            //Obtener ID del país por cookie
            $countryId = Cookie::get('country_id');
        }

        return $countryId;
    }

    public function setCart(int $productId, int $quantity): void {
        //Obtener información del usuario
        $user = Auth::user();

        if ($user) {
            //Guardar producto en carrito de compras
            $user->cart()->updateOrCreate(
                [ 'catalog_country_id' => $this->session->get('country.id'), 'product_id' => $productId ],
                [ 'quantity' => $quantity ]
            );
        } else {
            //Obtener carrito de compras de sesión
            $cart = $this->session->get('cart', []);

            //Verificar si el producto ya existe en el carrito de compras
            $index = array_search($productId, array_column($cart, 'id'));

            if ($index !== false) {
                //Actualizar cantidad del producto
                $cart[$index]['quantity'] = $quantity;
            } else {
                //Consultar información del producto
                $product = Product::with([ 'catalogProductBrand' ])->active($this->session->get('country.id'))->find($productId);

                if ($product) {
                    //Agregar producto al carrito de compras
                    $cart[] = [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'sku' => $product->sku,
                        'name' => $product->name,
                        'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $product->image,
                        'price' => formatPriceWithCurrency($product->suggested_price, $this->session->get('country')),
                        'quantity' => $quantity,
                        'total' => formatPriceWithCurrency($product->suggested_price * $quantity, $this->session->get('country')),
                        'available' => array_values($product->getAvailability())[0],
                        'rating' => $product->rating_total,
                        'brandSlug' => $product->catalogProductBrand->slug
                    ];
                }
            }

            //Guardar carrito de compras en sesión
            $this->session->put('cart', $cart);
        }
    }

    public function getCart(): array {
        //Obtener información del usuario
        $user = Auth::user();

        if ($user) {
            //Obtener carrito de compras de base de datos
            return $user->cart()
            ->with('product', 'product.catalogProductBrand')
            ->whereHas('product', fn($query) => $query->active($this->session->get('country.id')))
            ->country($this->session->get('country.id'))
            ->get()
            ->map(function($cart) {
                return [
                    'id' => $cart->product->id,
                    'slug' => $cart->product->slug,
                    'sku' => $cart->product->sku,
                    'name' => $cart->product->name,
                    'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $cart->product->image,
                    'price' => formatPriceWithCurrency($cart->product->suggested_price, $this->session->get('country')),
                    'quantity' => $cart->quantity,
                    'total' => formatPriceWithCurrency($cart->product->suggested_price * $cart->quantity, $this->session->get('country')),
                    'available' => array_values($cart->product->getAvailability())[0],
                    'rating' => $cart->product->rating_total,
                    'brandSlug' => $cart->product->catalogProductBrand->slug
                ];
            })
            ->toArray();
        } else {
            //Obtener carrito de compras de sesión
            return $this->session->get('cart', []);
        }
    }

    public function removeCart(int $productId): void {
        //Obtener información del usuario
        $user = Auth::user();

        if ($user) {
            //Eliminar producto del carrito de compras
            $user->cart()
            ->where('product_id', $productId)
            ->country($this->session->get('country.id'))
            ->delete();
        } else {
            //Obtener carrito de compras de sesión
            $cart = $this->session->get('cart', []);

            //Verificar si el producto ya existe en el carrito de compras
            $index = array_search($productId, array_column($cart, 'id'));

            if ($index !== false) {
                //Eliminar producto del carrito de compras
                unset($cart[$index]);
            }

            //Guardar carrito de compras en sesión
            $this->session->put('cart', $cart);
        }
    }
}

class SessionControllerCountry {
    public function __construct(public int $id, public string $code, public string $name, public float $vat, public string $currency_symbol, public int $currency_decimal) {}

    public static function toObject(array $country): object {
        //Generar objeto
        return new self(id: $country['id'], code: $country['code'], name: $country['name'], vat: $country['vat'], currency_symbol: $country['currency_symbol'], currency_decimal: $country['currency_decimal']);
    }

    public function toArray(): array {
        //Generar array
        return [ 'id' => $this->id, 'code' => $this->code, 'name' => $this->name, 'vat' => $this->vat, 'currency_symbol' => $this->currency_symbol, 'currency_decimal' => $this->currency_decimal ];
    }
}

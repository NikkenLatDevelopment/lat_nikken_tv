<?php

namespace App\Models;

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

    public function getCountry(): ?SessionControllerCountry {
        //Obtener información
        $country = $this->session->get('country');

        //Generar objeto
        return $country ? SessionControllerCountry::toObject($country) : null;
    }

    public function getCountryId(): ?int {
        //Obtener ID del país por sesión o cookie
        return $this->session->get('country.id', Cookie::get('country_id'));
    }

    public function setCart(int $productId, int $quantity): void {
        auth()->check()
        ? $this->setCartForAuthenticatedUser($productId, $quantity)
        : $this->setCartForGuestUser($productId, $quantity);
    }

    public function setCartForAuthenticatedUser(int $productId, int $quantity): void {
        //Guardar producto en base de datos
        auth()->user()->cart()->updateOrCreate(
            [ 'catalog_country_id' => $this->session->get('country.id'), 'product_id' => $productId ],
            [ 'quantity' => $quantity ]
        );
    }

    public function setCartForGuestUser(int $productId, int $quantity): void {
        //Obtener carrito de compras de sesión
        $cart = $this->session->get('cart', []);

        //Verificar si el producto ya existe
        $index = array_search($productId, array_column($cart, 'id'));

        if ($index !== false) {
            //Actualizar cantidad del producto
            $cart[$index]['quantity'] = $quantity;
        } else {
            //Consultar información del producto
            $product = Product::with([
                'catalogProductBrand',
                'productComponents.product' => fn ($query) => $query->select('id', 'sku', 'name', 'stock', 'stock_applies', 'available_until')
            ])
            ->active($this->session->get('country.id'))
            ->find($productId);

            if ($product) {
                //Agregar producto
                $cart[] = formatCartProduct($product, $quantity, $this->session->get('country'));
            }
        }

        //Actualizar carrito de compras
        $this->session->put('cart', $cart);
    }

    public function getCart(): array {
        return auth()->check()
        ? $this->getCartForAuthenticatedUser()
        : $this->getCartForGuestUser();
    }

    public function getCartForAuthenticatedUser(): array {
        //Obtener carrito de compras de base de datos
        return auth()->user()->cart()
        ->with([
            'product',
            'product.catalogProductBrand',
            'product.productComponents.product' => fn ($query) => $query->select('id', 'sku', 'name', 'stock', 'stock_applies', 'available_until')
        ])
        ->whereHas('product', fn($query) => $query->active($this->session->get('country.id')))
        ->country($this->session->get('country.id'))
        ->get()
        ->map(function($cart) { return formatCartProduct($cart->product, $cart->quantity, $this->session->get('country')); })
        ->toArray();
    }

    public function getCartForGuestUser(): array {
        //Obtener carrito de compras de sesión
        $cart = $this->session->get('cart', []);

        //Obtener Ids de los productos
        $productIds = array_column($cart, 'id');
        if (empty($productIds)) { return []; }

        //Consultar información de los productos
        $products = Product::with([
            'catalogProductBrand',
            'productComponents.product' => fn ($query) => $query->select('id', 'sku', 'name', 'stock', 'stock_applies', 'available_until')
        ])
        ->active($this->session->get('country.id'))
        ->whereIn('id', $productIds)
        ->get()
        ->keyBy('id');

        foreach ($cart as $index => $item) {
            //Obtener información del producto
            $product = $products->get($item['id']);

            if ($product) {
                //Actualizar información del producto
                $cart[$index] = formatCartProduct($product, $item['quantity'], $this->session->get('country'));
            } else {
                //Eliminar producto
                unset($cart[$index]);
            }
        }

        //Actualizar carrito de compras
        $this->session->put('cart', $cart);

        return $cart;
    }

    public function removeCart(int $productId): void {
        auth()->check()
        ? $this->removeCartForAuthenticatedUser($productId)
        : $this->removeCartForGuestUser($productId);
    }

    public function removeCartForAuthenticatedUser(int $productId): void {
        //Eliminar producto en base de datos
        auth()->user()->cart()
        ->where('product_id', $productId)
        ->country($this->session->get('country.id'))
        ->delete();
    }

    public function removeCartForGuestUser(int $productId): void {
        //Obtener carrito de compras de sesión
        $cart = $this->session->get('cart', []);

        //Verificar si el producto existe
        $index = array_search($productId, array_column($cart, 'id'));

        if ($index !== false) {
            //Eliminar producto
            unset($cart[$index]);
        }

        //Actualizar carrito de compras
        $this->session->put('cart', $cart);
    }

    public function setDiscountSuggestedPrice(bool $discountSuggestedPrice): void {
        //Validar si el país y el tipo de usuario permiten sugerido con descuento
        if (auth()->check() && $this->session->get('country.id') == 1 && auth()->user()->catalog_user_type_id == 3) {
            //Guardar sugerido con descuento en sesión
            $this->session->put('discount_suggested_price', $discountSuggestedPrice);

            //Guardar sugerido con descuento en cookie
            Cookie::queue('discount_suggested_price', $discountSuggestedPrice);
        }
    }

    public function getDiscountSuggestedPrice(): bool {
        //Validar si el país y el tipo de usuario permiten sugerido con descuento
        if (auth()->check() && $this->session->get('country.id') == 1 && auth()->user()->catalog_user_type_id == 3) {
            //Obtener sugerido con descuento por sesión o cookie
            return $this->session->get('discount_suggested_price', Cookie::get('discount_suggested_price', false));
        }

        return false;
    }
}

class SessionControllerCountry {
    public function __construct(public int $id, public string $code, public string $name, public string $abbrev, public float $vat, public string $currency_symbol, public int $currency_decimal) {}

    public static function toObject(array $country): object {
        //Generar objeto
        return new self(id: $country['id'], code: $country['code'], name: $country['name'], abbrev: $country['abbrev'], vat: $country['vat'], currency_symbol: $country['currency_symbol'], currency_decimal: $country['currency_decimal']);
    }

    public function toArray(): array {
        //Generar array
        return [ 'id' => $this->id, 'code' => $this->code, 'name' => $this->name, 'abbrev' => $this->abbrev, 'vat' => $this->vat, 'currency_symbol' => $this->currency_symbol, 'currency_decimal' => $this->currency_decimal ];
    }
}



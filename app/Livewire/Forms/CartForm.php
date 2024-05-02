<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Form;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class CartForm extends Form
{
    #[Locked]
    public array $catalogCountry = [];

    #[Locked]
    public array $products = [];

    #[Locked]
    public int $quantity = 0;

    #[Locked]
    public string $subtotalText = '';

    #[Locked]
    public string $retailText = '';

    #[Locked]
    public string $vatText = '';

    #[Locked]
    public string $totalText = '';

    #[Locked]
    public string $pointsText = '';

    #[Locked]
    public string $vcText = '';

    #[Locked]
    public bool $discountSuggestedPrice = false;

    public function getProducts(SessionController $sessionController) {
        //Obtener productos del carrito de compras
        $this->products = $sessionController->getCart();
    }

    public function remove(int $productId, bool $DB, SessionController $sessionController): bool {
        //Verificar si el producto existe en el array del carrito de compras
        $index = array_search($productId, array_column($this->products, 'id'));
        if ($index === false) { return false; }

        if ($DB) {
            //Eliminar producto del carrito de compras
            $sessionController->removeCart($productId);
        }

        //Eliminar producto del array del carrito de compras
        unset($this->products[$index]);

        //Reorganizar índices del array del carrito de compras
        $this->products = array_values($this->products);

        //Retornar
        return true;
    }

    public function getTotals() {
        //Sumar la cantidad de todos los productos
        $totalQuantityProducts = array_sum(array_column($this->products, 'quantity'));

        //Sumar el subtotal de todos los productos
        $totalSubtotalProducts = array_sum(array_column($this->products, 'subtotal'));

        //Sumar el retail de todos los productos
        $totalRetailProducts = array_sum(array_column($this->products, 'retail'));

        //Sumar el IVA del retail de todos los productos
        $totalVatRetailProducts = array_sum(array_column($this->products, 'vatRetail'));

        //Sumar el IVA de todos los productos
        $totalVatProducts = array_sum(array_column($this->products, 'vat'));

        //Sumar los puntos de todos los productos
        $totalPointsProducts = array_sum(array_column($this->products, 'points'));

        //Sumar el VC de todos los productos
        $totalVcProducts = array_sum(array_column($this->products, 'vc'));

        $this->quantity = $totalQuantityProducts;
        $this->subtotalText = formatPriceWithCurrency($totalSubtotalProducts, $this->catalogCountry);
        $this->pointsText = formatPrice($totalPointsProducts, 0);
        $this->vcText = formatPriceWithCurrency($totalVcProducts, $this->catalogCountry);
        $this->retailText = formatPriceWithCurrency($totalRetailProducts, $this->catalogCountry);

        if ($this->discountSuggestedPrice) {
            $this->vatText = formatPriceWithCurrency($totalVatProducts - $totalVatRetailProducts, $this->catalogCountry);
            $this->totalText = formatPriceWithCurrency(($totalSubtotalProducts - $totalRetailProducts) + ($totalVatProducts - $totalVatRetailProducts), $this->catalogCountry);
        } else {
            $this->vatText = formatPriceWithCurrency($totalVatProducts, $this->catalogCountry);
            $this->totalText = formatPriceWithCurrency($totalSubtotalProducts + $totalVatProducts, $this->catalogCountry);
        }
    }

    public function changeDiscountSuggestedPrice(bool $discountSuggestedPrice, bool $DB, SessionController $sessionController): bool {
        if ($DB) {
            //Validar sesión del usuario
            if (!auth()->check()) { return false; }

            //Validar información
            $validator = Validator::make(
                [
                    'catalogCountryId' => $this->catalogCountry['id'],
                    'catalogUserTypeId' => auth()->user()->catalog_user_type_id
                ],
                [
                    'catalogCountryId' => 'required|integer|in:1',
                    'catalogUserTypeId' => 'required|integer|in:3'
                ]
            );

            if ($validator->fails()) {
                //No permitir sugerido con descuento
                $discountSuggestedPrice = false;
            }

            //Guardar sugerido con descuento en sesión y cookie
            $sessionController->setDiscountSuggestedPrice($discountSuggestedPrice);
        }

        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $discountSuggestedPrice;

        //Retornar sugerido con descuento
        return $this->discountSuggestedPrice;
    }

    public function changeQuantity(int $productId, int $quantity, bool $DB, SessionController $sessionController): array {
        //Verificar si el producto existe
        $index = array_search($productId, array_column($this->products, 'id'));
        if ($index === false) { return [ [], false ]; }

        if ($DB) {
            //Validar información
            $validator = Validator::make([ 'quantity' => $quantity ], [ 'quantity' => 'required|integer|min:1|max:99' ]);

            if ($validator->fails()) {
                //Retornar producto sin cambios
                return [ $this->products[$index], false ];
            }

            //Actualizar cantidad del producto
            $sessionController->setCart($productId, $quantity);
        }

        //Obtener información del producto
        $product = Product::basicData()
        ->with([
            'catalogProductBrand',
            'productComponents.product' => fn ($query) => $query->availabilityData(),
        ])->find($productId);

        if ($product) {
            //Actualizar información del producto
            $this->products[$index] = formatCartProduct($product, $quantity, $this->catalogCountry);

            //Retornar producto actualizado
            return [ $this->products[$index], true ];
        } else {
            //Retornar producto sin cambios
            return [ $this->products[$index], false ];
        }
    }
}

<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class CartForm extends Form
{
    #[Locked]
    public array $country = [];

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

    public function removeProduct(int $index, int $productId, SessionController $sessionController) {
        //Validar información
        Validator::make(
            [ 'productId' => $productId ],
            [ 'productId' => 'required|integer|exists:products,id' ]
        )->validate();

        //Eliminar producto del carrito de compras
        $sessionController->removeCart($productId);
        unset($this->products[$index]);
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
        $this->subtotalText = formatPriceWithCurrency($totalSubtotalProducts, $this->country);
        $this->pointsText = formatPrice($totalPointsProducts, 0);
        $this->vcText = formatPriceWithCurrency($totalVcProducts, $this->country);
        $this->retailText = formatPriceWithCurrency($totalRetailProducts, $this->country);

        if ($this->discountSuggestedPrice) {
            $this->vatText = formatPriceWithCurrency($totalVatProducts - $totalVatRetailProducts, $this->country);
            $this->totalText = formatPriceWithCurrency(($totalSubtotalProducts - $totalRetailProducts) + ($totalVatProducts - $totalVatRetailProducts), $this->country);
        } else {
            $this->vatText = formatPriceWithCurrency($totalVatProducts, $this->country);
            $this->totalText = formatPriceWithCurrency($totalSubtotalProducts + $totalVatProducts, $this->country);
        }
    }

    public function changeDiscountSuggestedPrice(bool $discountSuggestedPrice, SessionController $sessionController): bool {
        //Validar sesión del usuario
        if (!auth()->check()) { return false; }

        //Validar información
        $validator = Validator::make(
            [
                'countryId' => $this->country['id'],
                'userTypeId' => auth()->user()->catalog_user_type_id
            ],
            [
                'countryId' => 'required|in:1',
                'userTypeId' => 'required|in:3'
            ]
        );

        if ($validator->fails()) {
            //No permitir sugerido con descuento
            $discountSuggestedPrice = false;
        }

        //Guardar sugerido con descuento en sesión y cookie
        $sessionController->setDiscountSuggestedPrice($discountSuggestedPrice);

        //Actualizar permiso sugerido con descuento
        $this->discountSuggestedPrice = $discountSuggestedPrice;
        return $this->discountSuggestedPrice;
    }
}

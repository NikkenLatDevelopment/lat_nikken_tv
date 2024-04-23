<?php

namespace App\Livewire\General\Header\Content\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class Products extends Component
{
    #[Locked]
    public array $country = [];

    #[Locked]
    public array $products = [];

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

    public bool $discountSuggestedPrice = false;

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.cart.products');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Validar si el país y el tipo de usuario permiten sugerido con descuento
        if (auth()->check() && $this->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3) {
            //Obtener sugerido con descuento
            $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();
        }

        //Obtener carrito de compras
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.cart.products.getProducts')]
    public function getProducts(SessionController $sessionController) {
        //Obtener carrito de compras
        $this->products = $sessionController->getCart();

        //Obtener totales
        $this->getTotals();
    }

    public function removeProduct(int $index, int $productId, SessionController $sessionController) {
        //Validar información
        Validator::make(
            [ 'productId' => $productId ],
            [ 'productId' => 'required|integer|exists:products,id' ]
        )->validate();

        //Eliminar producto del carrito de compras
        $sessionController->removeCart($productId);

        //Eliminar producto del carrito de compras
        unset($this->products[$index]);

        //Obtener totales
        $this->getTotals();

        //Emitir evento para mostrar el mensaje de confirmación
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');
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

        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.getTotalProducts', productsTotal: $totalQuantityProducts);
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Validar sesión del usuario
        if (!auth()->check()) { return; }

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
            $this->discountSuggestedPrice = false;
            return;
        }

        //Guardar sugerido con descuento en sesión y cookie
        $sessionController->setDiscountSuggestedPrice($this->discountSuggestedPrice);

        //Obtener totales
        $this->getTotals();
    }
}

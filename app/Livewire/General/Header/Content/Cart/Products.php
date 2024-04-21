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
    public string $vatText = '';

    #[Locked]
    public string $totalText = '';

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.cart.products');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Obtener carrito de compras
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.cart.products.getProducts')]
    public function getProducts(SessionController $sessionController) {
        //Obtener carrito de compras
        $this->products = $sessionController->getCart();

        //Sumar la cantidad de todos los productos
        $totalQuantityProducts = array_sum(array_column($this->products, 'quantity'));

        //Obtener totales
        $this->getTotals();

        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.getTotalProducts', productsTotal: $totalQuantityProducts);
    }

    public function removeProduct(int $index, int $productId, SessionController $sessionController) {
        //Validar información
        Validator::make(
            [ 'productId' => $productId ],
            [ 'productId' => 'required|integer|exists:products,id' ]
        )->validate();

        //Eliminar producto del carrito de compras en base de datos
        $sessionController->removeCart($productId);

        //Eliminar producto del carrito de compras
        unset($this->products[$index]);

        //Sumar la cantidad de todos los productos
        $totalQuantityProducts = array_sum(array_column($this->products, 'quantity'));

        //Obtener totales
        $this->getTotals();

        //Mostrar mensaje
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.getTotalProducts', productsTotal: $totalQuantityProducts);
    }

    public function getTotals() {
        //Sumar el total de todos los productos
        $totalProducts = array_sum(array_column($this->products, 'total'));

        //Sumar el IVA de todos los productos
        $totalVat = array_sum(array_column($this->products, 'vat'));

        //Inicializar información
        $this->subtotalText = formatPriceWithCurrency($totalProducts - $totalVat, $this->country);
        $this->vatText = formatPriceWithCurrency($totalVat, $this->country);
        $this->totalText = formatPriceWithCurrency($totalProducts, $this->country);
    }
}

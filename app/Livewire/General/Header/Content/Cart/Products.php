<?php

namespace App\Livewire\General\Header\Content\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SessionController;
use App\Livewire\Forms\CartForm;

class Products extends Component
{
    public CartForm $cartForm;
    public bool $discountSuggestedPrice = false;

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.cart.products');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país en sesión
        $this->cartForm->catalogCountry = $sessionController->getCatalogCountry()->toArray();

        //Obtener información del sugerido con descuento
        $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();
        $this->cartForm->discountSuggestedPrice = $this->discountSuggestedPrice;

        //Obtener productos del carrito de compras
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.cart.products.getProducts')]
    public function getProducts(SessionController $sessionController) {
        //Obtener productos del carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Generar los cálculos del carrito de compras
        $this->getTotals();
    }

    #[On('general.header.content.cart.products.remove')]
    public function remove(int $id, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($id, true, $sessionController);

        if ($validate) {
            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

            //Emitir evento para eliminar el producto del carrito de compras
            $this->dispatch('checkout.index.content.main.removeProductExternal', id: $id);

            //Generar los cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('general.header.content.cart.products.removeExternal')]
    public function removeProductExternal(int $id, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($id, false, $sessionController);

        if ($validate) {
            //Generar los cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('general.header.content.cart.products.changeQuantity')]
    public function changeQuantity(int $id, int $quantity, SessionController $sessionController) {
        //Actualizar cantidad del producto en el carrito de compras
        $validate = $this->cartForm->changeQuantity($id, $quantity, false, $sessionController)[1];

        if ($validate) {
            //Generar los cálculos del carrito de compras
            $this->getTotals();
        }
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($this->discountSuggestedPrice, true, $sessionController);

        //Generar los cálculos del carrito de compras
        $this->getTotals();

        //Emitir evento para actualizar el sugerido con descuento
        $this->dispatch('checkout.index.content.main.updatedDiscountSuggestedPriceExternal', discountSuggestedPrice: $this->discountSuggestedPrice);
    }

    #[On('general.header.content.cart.products.updatedDiscountSuggestedPriceExternal')]
    public function updatedDiscountSuggestedPriceExternal(bool $discountSuggestedPrice, SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($discountSuggestedPrice, false, $sessionController);

        //Generar los cálculos del carrito de compras
        $this->getTotals();
    }

    public function getTotals() {
        //Generar los cálculos del carrito de compras
        $this->cartForm->getTotals();

        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.getCountProducts', countProducts: $this->cartForm->quantity);
    }
}

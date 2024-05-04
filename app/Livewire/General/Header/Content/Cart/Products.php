<?php

namespace App\Livewire\General\Header\Content\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\CartForm;
use App\Models\SessionController;

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

        //Obtener información de sugerido con descuento
        $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();
        $this->cartForm->discountSuggestedPrice = $this->discountSuggestedPrice;

        //Obtener productos del carrito de compras
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.cart.products.getProducts')]
    public function getProducts(SessionController $sessionController) {
        //Obtener productos del carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Generar cálculos del carrito de compras
        $this->getTotals();
    }

    #[On('general.header.content.cart.products.remove')]
    public function remove(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($productId, true, $sessionController);

        if ($validate) {
            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

            //Emitir evento para eliminar el producto del carrito de compras en el checkout
            $this->dispatch('checkout.index.main.removeProductExternal', productId: $productId);

            //Generar cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('general.header.content.cart.products.removeExternal')]
    public function removeExternal(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($productId, false, $sessionController);

        if ($validate) {
            //Generar cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('general.header.content.cart.products.changeQuantity')]
    public function changeQuantity(int $productId, int $quantity, SessionController $sessionController) {
        //Actualizar la cantidad del producto en el carrito de compras
        $validate = $this->cartForm->changeQuantity($productId, $quantity, false, $sessionController)[1];

        if ($validate) {
            //Generar cálculos del carrito de compras
            $this->getTotals();
        }
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($this->discountSuggestedPrice, true, $sessionController);

        //Generar cálculos del carrito de compras
        $this->getTotals();

        //Emitir evento para actualizar el sugerido con descuento en el checkout
        $this->dispatch('checkout.index.main.updatedDiscountSuggestedPriceExternal', discountSuggestedPrice: $this->discountSuggestedPrice);
    }

    #[On('general.header.content.cart.products.updatedDiscountSuggestedPriceExternal')]
    public function updatedDiscountSuggestedPriceExternal(bool $discountSuggestedPrice, SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($discountSuggestedPrice, false, $sessionController);

        //Generar cálculos del carrito de compras
        $this->getTotals();
    }

    public function getTotals() {
        //Generar cálculos del carrito de compras
        $this->cartForm->getTotals();

        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.setCountProducts', countProducts: $this->cartForm->quantity);
    }
}

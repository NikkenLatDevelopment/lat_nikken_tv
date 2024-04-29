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
        //Obtener información del país
        $this->cartForm->country = $sessionController->getCountry()->toArray();

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

        //Calcular totales
        $this->getTotals();
    }

    #[On('general.header.content.cart.products.removeProduct')]
    public function removeProduct(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->removeProduct($productId, true, $sessionController);

        if ($validate) {
            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

            //Emitir evento para eliminar el producto del carrito de compras
            $this->dispatch('checkout.index.content.main.removeProductExternal', productId: $productId);

            //Calcular totales
            $this->getTotals();
        }
    }

    #[On('general.header.content.cart.products.removeProductExternal')]
    public function removeProductExternal(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->removeProduct($productId, false, $sessionController);

        if ($validate) {
            //Calcular totales
            $this->getTotals();
        }
    }

    #[On('general.header.content.cart.products.changeQuantity')]
    public function changeQuantity(int $productId, int $quantity, SessionController $sessionController) {
        //Actualizar cantidad del producto en el carrito de compras
        $validate = $this->cartForm->changeQuantity($productId, $quantity, false, $sessionController)[1];

        if ($validate) {
            //Calcular totales
            $this->getTotals();
        }
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($this->discountSuggestedPrice, true, $sessionController);

        //Calcular totales
        $this->getTotals();

        //Emitir evento para actualizar el sugerido con descuento
        $this->dispatch('checkout.index.content.main.updatedDiscountSuggestedPriceExternal', discountSuggestedPrice: $this->discountSuggestedPrice);
    }

    #[On('general.header.content.cart.products.updatedDiscountSuggestedPriceExternal')]
    public function updatedDiscountSuggestedPriceExternal(bool $discountSuggestedPrice, SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($discountSuggestedPrice, false, $sessionController);

        //Calcular totales
        $this->getTotals();
    }

    public function getTotals() {
        //Calcular totales
        $this->cartForm->getTotals();

        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.getTotalProducts', productsTotal: $this->cartForm->quantity);
    }
}

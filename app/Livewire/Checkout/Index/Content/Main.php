<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\CartForm;
use App\Models\SessionController;

class Main extends Component
{
    public CartForm $cartForm;
    public bool $discountSuggestedPrice = false;

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.main');
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

    public function getProducts(SessionController $sessionController) {
        //Obtener productos del carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Calcular totales
        $this->getTotals();
    }

    public function getTotals() {
        //Calcular totales
        $this->cartForm->getTotals();
    }

    #[On('checkout.index.content.main.removeProduct')]
    public function removeProduct(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->removeProduct($productId, true, $sessionController);

        if ($validate) {
            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

            //Emitir evento para eliminar el producto del carrito de compras del menú
            $this->dispatch('general.header.content.cart.products.removeProductExternal', productId: $productId);

            //Calcular totales
            $this->getTotals();
        }
    }

    #[On('checkout.index.content.main.removeProductExternal')]
    public function removeProductExternal(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->removeProduct($productId, false, $sessionController);

        if ($validate) {
            //Calcular totales
            $this->getTotals();
        }
    }

    #[On('checkout.index.content.main.changeQuantity')]
    public function changeQuantity(int $productId, int $quantity, SessionController $sessionController) {
        //Actualizar cantidad del producto en el carrito de compras
        list($product, $validate) = $this->cartForm->changeQuantity($productId, $quantity, true, $sessionController);

        //Emitir evento para actualizar el producto en el carrito de compras
        $this->dispatch('checkout.index.content.resumeProduct.refreshProduct.' . $productId, product: $product);

        if ($validate) {
            //Emitir evento para cambiar la cantidad del producto en el carrito de compras del menú
            $this->dispatch('general.header.content.cart.products.changeQuantity', productId: $productId, quantity: $quantity);

            //Calcular totales
            $this->getTotals();
        }
    }
}

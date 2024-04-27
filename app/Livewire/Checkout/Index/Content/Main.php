<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\CartForm;
use App\Models\SessionController;
use Livewire\Attributes\Reactive;

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

        //Validar si el país y el tipo de usuario permiten sugerido con descuento
        if (auth()->check() && $this->cartForm->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3) {
            //Obtener sugerido con descuento
            $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();
            $this->cartForm->discountSuggestedPrice = $this->discountSuggestedPrice;
        }

        //Obtener carrito de compras
        $this->getProducts($sessionController);
    }

    public function getProducts(SessionController $sessionController) {
        //Obtener carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Obtener totales
        $this->getTotals();
    }

    public function getTotals() {
        //Obtener totales
        $this->cartForm->getTotals();
    }

    #[On('checkout.index.content.main.removeProduct')]
    public function removeProduct(int $index, int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $this->cartForm->removeProduct($index, $productId, $sessionController);

        //Emitir evento para mostrar el mensaje de confirmación
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

        //Emitir evento para eliminar el producto del carrito de compras
        $this->dispatch('general.header.content.cart.products.removeProductExternal', index: $index);

        //Obtener totales
        $this->getTotals();
    }

    #[On('checkout.index.content.main.removeProductExternal')]
    public function removeProductExternal(int $index) {
        //Eliminar producto del carrito de compras
        unset($this->cartForm->products[$index]);

        //Obtener totales
        $this->getTotals();
    }

    #[On('checkout.index.content.main.changeQuantity')]
    public function changeQuantity(int $index, int $productId, int $quantity, bool $DB, SessionController $sessionController) {
        //Actualizar cantidad del producto
        $this->cartForm->changeQuantity($index, $productId, $quantity, $DB, $sessionController);

        //Emitir evento para cambiar la cantidad del producto del carrito de compras
        $this->dispatch('general.header.content.cart.products.changeQuantity', index: $index, productId: $productId, quantity: $quantity, DB: false);

        //Obtener totales
        $this->getTotals();
    }
}

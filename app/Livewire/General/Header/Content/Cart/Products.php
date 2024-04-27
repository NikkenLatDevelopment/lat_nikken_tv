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

        //Validar si el país y el tipo de usuario permiten sugerido con descuento
        if (auth()->check() && $this->cartForm->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3) {
            //Obtener sugerido con descuento
            $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();
            $this->cartForm->discountSuggestedPrice = $this->discountSuggestedPrice;
        }

        //Obtener carrito de compras
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.cart.products.getProducts')]
    public function getProducts(SessionController $sessionController) {
        //Obtener carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Obtener totales
        $this->getTotals();
    }

    public function removeProduct(int $index, int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $this->cartForm->removeProduct($index, $productId, $sessionController);

        //Emitir evento para mostrar el mensaje de confirmación
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

        //Emitir evento para eliminar el producto del carrito de compras
        $this->dispatch('checkout.index.content.main.removeProductExternal', index: $index);

        //Obtener totales
        $this->getTotals();
    }

    #[On('general.header.content.cart.products.removeProductExternal')]
    public function removeProductExternal(int $index) {
        //Eliminar producto del carrito de compras
        unset($this->cartForm->products[$index]);

        //Obtener totales
        $this->getTotals();
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($this->discountSuggestedPrice, $sessionController);

        //Obtener totales
        $this->getTotals();
    }

    #[On('general.header.content.cart.products.changeQuantity')]
    public function changeQuantity(int $index, int $productId, int $quantity, bool $DB, SessionController $sessionController) {
        //Actualizar cantidad del producto
        $this->cartForm->changeQuantity($index, $productId, $quantity, $DB, $sessionController);

        //Obtener totales
        $this->getTotals();
    }

    public function getTotals() {
        //Obtener totales
        $this->cartForm->getTotals();

        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.getTotalProducts', productsTotal: $this->cartForm->quantity);
    }
}

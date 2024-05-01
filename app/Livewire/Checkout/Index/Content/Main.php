<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Livewire\Forms\CartForm;
use App\Models\SessionController;
use App\Livewire\Forms\AddressForm;

class Main extends Component
{
    public CartForm $cartForm;
    public AddressForm $addressForm;

    public bool $discountSuggestedPrice = false;

    public string $state;
    public string $municipality;
    public string $colony;
    public int $postalCode;

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.main');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $country = $sessionController->getCountry()->toArray();

        //Obtener información del sugerido con descuento
        $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();

        //Iniciar formulario carrito de compras
        $this->cartForm->country = $country;
        $this->cartForm->discountSuggestedPrice = $this->discountSuggestedPrice;

        //Obtener productos del carrito de compras
        $this->getProducts($sessionController);

        //Iniciar formulario dirección
        $this->addressForm->country = $country;

        if ($this->addressForm->country['id'] != 2) {
            //Obtener catálogo de estados
            $this->addressForm->getCatalogStates();
        }

        //Obtener la cantidad de direcciones registradas
        $this->addressForm->getTotalAddresses();
    }

    public function getProducts(SessionController $sessionController) {
        //Obtener productos del carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Calcular totales carrito de compras
        $this->getTotals();
    }

    public function getTotals() {
        if (empty($this->cartForm->products)) {
            //Redireccionar
            return redirect()->route('home');
        }

        //Calcular totales carrito de compras
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

            //Calcular totales carrito de compras
            $this->getTotals();
        }
    }

    #[On('checkout.index.content.main.removeProductExternal')]
    public function removeProductExternal(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->removeProduct($productId, false, $sessionController);

        if ($validate) {
            //Calcular totales carrito de compras
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
            //Calcular totales carrito de compras
            $this->getTotals();

            //Emitir evento para cambiar la cantidad del producto en el carrito de compras del menú
            $this->dispatch('general.header.content.cart.products.changeQuantity', productId: $productId, quantity: $quantity);
        }
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($this->discountSuggestedPrice, true, $sessionController);

        //Calcular totales carrito de compras
        $this->getTotals();

        //Emitir evento para actualizar el sugerido con descuento en el menú
        $this->dispatch('general.header.content.cart.products.updatedDiscountSuggestedPriceExternal', discountSuggestedPrice: $this->discountSuggestedPrice);
    }

    #[On('checkout.index.content.main.updatedDiscountSuggestedPriceExternal')]
    public function updatedDiscountSuggestedPriceExternal(bool $discountSuggestedPrice, SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($discountSuggestedPrice, false, $sessionController);

        //Calcular totales carrito de compras
        $this->getTotals();
    }

    public function updatedState() {
        //Validar información
        $this->validate([ 'state' => 'required|string|max:40' ]);

        //Limpiar municipio
        $this->municipality = '';

        //Obtener catálogo de municipios
        $this->addressForm->getCatalogMunicipalities($this->state);
    }

    public function updatedMunicipality() {
        //Validar si el país aplica para obtener las colonias
        if (in_array($this->addressForm->country['id'], [ 3, 4, 5, 8, 10 ])) {
            //Validar información
            $this->validate([
                'state' => 'required|string|max:40',
                'municipality' => 'required|string|max:40'
            ]);

            //Limpiar colonia
            $this->colony = '';

            //Obtener catálogo de colonias
            $this->addressForm->getCatalogColonies($this->state, $this->municipality);
        }
    }

    public function updatedPostalCode() {
        //Validar si el país aplica para obtener el código postal
        if ($this->addressForm->country['id'] == 2) {
            //Validar información
            $this->validate([ 'postalCode' => 'required|max:5|min:5' ], [], [ 'postalCode' => 'código postal' ]);

            //Limpiar estado
            $this->state = '';

            //Limpiar municipio
            $this->municipality = '';

            //Limpiar colonia
            $this->colony = '';

            //Obtener catálogo de estados, municipios y colonias
            $this->addressForm->getCatalogMex($this->postalCode);
        }
    }
}

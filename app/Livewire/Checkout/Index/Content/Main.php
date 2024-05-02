<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Livewire\Forms\CartForm;
use App\Models\SessionController;
use App\Livewire\Forms\UserAddressForm;
use App\Models\CatalogSalePaymentMethod;

class Main extends Component
{
    #[Locked]
    public array $catalogSalePaymentMethods = [];

    public bool $discountSuggestedPrice = false;
    public int $selectedCatalogSalePaymentMethod;

    public CartForm $cartForm;
    public UserAddressForm $userAddressForm;

    public string $stateUserAddressForm;
    public string $municipalityUserAddressForm;
    public string $colonyUserAddressForm;
    public int $postalCodeUserAddressForm;

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.main');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país en sesión
        $catalogCountry = $sessionController->getCatalogCountry()->toArray();

        //Obtener información del sugerido con descuento
        $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();

        //Inicializar formulario carrito de compras
        $this->initializeCartForm($catalogCountry, $sessionController);

        //Inicializar formulario direcciones del usuario
        $this->initializeUserAddressForm($catalogCountry);

        //Obtener catálogo de formas de pago de la venta
        $this->getCatalogSalePaymentMethods($catalogCountry);
    }

    public function initializeCartForm(array $catalogCountry, SessionController $sessionController) {
        //Inicializar información
        $this->cartForm->catalogCountry = $catalogCountry;
        $this->cartForm->discountSuggestedPrice = $this->discountSuggestedPrice;

        //Obtener productos del carrito de compras
        $this->getProducts($sessionController);
    }

    public function initializeUserAddressForm(array $catalogCountry) {
        //Inicializar información
        $this->userAddressForm->catalogCountry = $catalogCountry;

        if ($this->userAddressForm->catalogCountry['id'] != 2) {
            //Obtener catálogo de estados
            $this->userAddressForm->getApiCatalogStates();
        }

        //Obtener la cantidad de direcciones del usuario
        $this->userAddressForm->getCountUserAddresses();
    }

    public function getProducts(SessionController $sessionController) {
        //Obtener productos del carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Generar los cálculos del carrito de compras
        $this->getTotals();
    }

    public function getTotals() {
        if (empty($this->cartForm->products)) {
            //Redireccionar
            return redirect()->route('home');
        }

        //Generar los cálculos del carrito de compras
        $this->cartForm->getTotals();
    }

    #[On('checkout.index.content.main.removeProduct')]
    public function removeProduct(int $id, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($id, true, $sessionController);

        if ($validate) {
            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

            //Emitir evento para eliminar el producto en el carrito de compras del menú
            $this->dispatch('general.header.content.cart.products.removeExternal', id: $id);

            //Generar los cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('checkout.index.content.main.removeProductExternal')]
    public function removeProductExternal(int $id, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($id, false, $sessionController);

        if ($validate) {
            //Generar los cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('checkout.index.content.main.changeQuantityProduct')]
    public function changeQuantityProduct(int $id, int $quantity, SessionController $sessionController) {
        //Actualizar cantidad del producto en el carrito de compras
        list($product, $validate) = $this->cartForm->changeQuantity($id, $quantity, true, $sessionController);

        //Emitir evento para actualizar el producto en el carrito de compras
        $this->dispatch('checkout.index.content.resumeProduct.updateProduct.' . $id, product: $product);

        if ($validate) {
            //Generar los cálculos del carrito de compras
            $this->getTotals();

            //Emitir evento para cambiar la cantidad del producto en el carrito de compras del menú
            $this->dispatch('general.header.content.cart.products.changeQuantity', id: $id, quantity: $quantity);
        }
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($this->discountSuggestedPrice, true, $sessionController);

        //Generar los cálculos del carrito de compras
        $this->getTotals();

        //Emitir evento para actualizar el sugerido con descuento del menú
        $this->dispatch('general.header.content.cart.products.updatedDiscountSuggestedPriceExternal', discountSuggestedPrice: $this->discountSuggestedPrice);
    }

    #[On('checkout.index.content.main.updatedDiscountSuggestedPriceExternal')]
    public function updatedDiscountSuggestedPriceExternal(bool $discountSuggestedPrice, SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($discountSuggestedPrice, false, $sessionController);

        //Generar los cálculos del carrito de compras
        $this->getTotals();
    }

    public function updatedStateUserAddressForm() {
        //Validar información
        $this->validate([ 'stateUserAddressForm' => 'required|string|max:255' ], [], [ 'stateUserAddressForm' => 'estado' ]);

        //Actualizar estado
        $this->userAddressForm->state = $this->stateUserAddressForm;

        //Limpiar información
        $this->municipalityUserAddressForm = '';
        $this->colonyUserAddressForm = '';
        $this->userAddressForm->municipality = '';
        $this->userAddressForm->colony = '';
        $this->userAddressForm->catalogMunicipalities = [];
        $this->userAddressForm->catalogColonies = [];

        //Obtener catálogo de municipios
        $this->userAddressForm->getApiCatalogMunicipalities();
    }

    public function updatedMunicipalityUserAddressForm() {
        //Actualizar municipio
        $this->userAddressForm->municipality = $this->municipality;

        //Limpiar información
        $this->colonyUserAddressForm = '';
        $this->userAddressForm->colony = '';
        $this->userAddressForm->catalogColonies = [];

        if (in_array($this->userAddressForm->catalogCountry['id'], [ 3, 4, 5, 8, 10 ])) {
            //Validar información
            $this->validate([
                'stateUserAddressForm' => 'required|string|max:255',
                'municipalityUserAddressForm' => 'required|string|max:255'
            ], [], [
                'stateUserAddressForm' => 'estado',
                'municipalityUserAddressForm' => 'municipio'
            ]);

            //Obtener catálogo de colonias
            $this->userAddressForm->getApiCatalogColonies();
        }
    }

    public function updatedColonyUserAddressForm() {
        //Validar información
        $this->validate([ 'colonyUserAddressForm' => 'required|string|max:255' ], [], [ 'colonyUserAddressForm' => 'colonia' ]);

        //Actualizar colonia
        $this->userAddressForm->colony = $this->colonyUserAddressForm;
    }

    public function updatedPostalCodeUserAddressForm() {
        if ($this->userAddressForm->catalogCountry['id'] == 2) {
            //Validar información
            $this->validate([ 'postalCodeUserAddressForm' => 'required|string|max:5|min:5' ], [], [ 'postalCodeUserAddressForm' => 'código postal' ]);

            //Actualizar código postal
            $this->userAddressForm->postalCode = $this->postalCodeUserAddressForm;

            //Limpiar información
            $this->stateUserAddressForm = '';
            $this->municipalityUserAddressForm = '';
            $this->colonyUserAddressForm = '';
            $this->userAddressForm->state = '';
            $this->userAddressForm->municipality = '';
            $this->userAddressForm->colony = '';
            $this->userAddressForm->catalogStates = [];
            $this->userAddressForm->catalogMunicipalities = [];
            $this->userAddressForm->catalogColonies = [];

            //Obtener catálogo de estados, municipios y colonias
            $this->userAddressForm->getApiCatalogs();
        }
    }

    #[On('checkout.index.content.main.changeSelectedUserAddressExternal')]
    public function changeSelectedUserAddressExternal(int $id) {
        //Guardar dirección seleccionada por el usuario
        $this->userAddressForm->selectedUserAddress = $id;
    }

    public function getCatalogSalePaymentMethods() {
        //Obtener catálogo de formas de pago de la venta
        $this->catalogSalePaymentMethods = CatalogSalePaymentMethod::catalogCountryId($this->catalogCountry['id'])
        ->status()
        ->get()
        ->toArray();
    }
}

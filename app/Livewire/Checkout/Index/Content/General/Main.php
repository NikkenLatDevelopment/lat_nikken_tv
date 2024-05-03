<?php

namespace App\Livewire\Checkout\Index\Content\General;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Livewire\Forms\CartForm;
use App\Livewire\Forms\UserAddressForm;
use App\Models\SessionController;
use App\Models\CatalogPaymentMethod;

class Main extends Component
{
    #[Locked]
    public int $countUserAddresses = 0;

    #[Locked]
    public int $selectedUserAddress;

    #[Locked]
    public array $catalogPaymentMethods = [];

    public bool $discountSuggestedPrice = false;
    public int $selectedCatalogPaymentMethod;
    public int $addressSelectionType = 0;

    public CartForm $cartForm;
    public UserAddressForm $userAddressForm;

    public string $stateUserAddressForm;
    public string $municipalityUserAddressForm;
    public int $postalCodeUserAddressForm;

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.general.main');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país en sesión
        $catalogCountry = $sessionController->getCatalogCountry()->toArray();

        //Obtener información de sugerido con descuento
        $this->discountSuggestedPrice = $sessionController->getDiscountSuggestedPrice();

        //Inicializar formulario carrito de compras
        $this->initializeCartForm($catalogCountry, $sessionController);

        //Inicializar formulario direcciones del usuario
        $this->initializeUserAddressForm($catalogCountry);

        //Obtener la cantidad de direcciones registradas por el usuario
        $this->getCountUserAddresses($catalogCountry['id']);

        //Obtener catálogo de formas de pago
        $this->getCatalogPaymentMethods($catalogCountry['id']);
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
        if ($this->userAddressForm->catalogCountry['id'] != 2) { $this->userAddressForm->getApiCatalogStates(); }
    }

    public function getProducts(SessionController $sessionController) {
        //Obtener productos del carrito de compras
        $this->cartForm->getProducts($sessionController);

        //Generar cálculos del carrito de compras
        $this->getTotals();
    }

    public function getTotals() {
        if (empty($this->cartForm->products)) {
            //Redireccionar
            return redirect()->route('home');
        }

        //Generar cálculos del carrito de compras
        $this->cartForm->getTotals();
    }

    #[On('checkout.index.content.general.main.removeProduct')]
    public function removeProduct(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($productId, true, $sessionController);

        if ($validate) {
            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu carrito de compras.', color: 'dark');

            //Emitir evento para eliminar el producto en el carrito de compras del menú
            $this->dispatch('general.header.content.cart.products.removeExternal', productId: $productId);

            //Generar cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('checkout.index.content.general.main.removeProductExternal')]
    public function removeProductExternal(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($productId, false, $sessionController);

        if ($validate) {
            //Generar cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('checkout.index.content.general.main.changeQuantityProduct')]
    public function changeQuantityProduct(int $productId, int $quantity, SessionController $sessionController) {
        //Actualizar la cantidad del producto en el carrito de compras
        list($product, $validate) = $this->cartForm->changeQuantity($productId, $quantity, true, $sessionController);

        //Emitir evento para actualizar el producto en el carrito de compras
        $this->dispatch('checkout.index.content.resume.product.update.' . $productId, product: $product);

        if ($validate) {
            //Generar cálculos del carrito de compras
            $this->getTotals();

            //Emitir evento para cambiar la cantidad del producto en el carrito de compras del menú
            $this->dispatch('general.header.content.cart.products.changeQuantity', productId: $productId, quantity: $quantity);
        }
    }

    public function updatedDiscountSuggestedPrice(SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($this->discountSuggestedPrice, true, $sessionController);

        //Generar cálculos del carrito de compras
        $this->getTotals();

        //Emitir evento para actualizar el sugerido con descuento del menú
        $this->dispatch('general.header.content.cart.products.updatedDiscountSuggestedPriceExternal', discountSuggestedPrice: $this->discountSuggestedPrice);
    }

    #[On('checkout.index.content.general.main.updatedDiscountSuggestedPriceExternal')]
    public function updatedDiscountSuggestedPriceExternal(bool $discountSuggestedPrice, SessionController $sessionController) {
        //Actualizar sugerido con descuento
        $this->discountSuggestedPrice = $this->cartForm->changeDiscountSuggestedPrice($discountSuggestedPrice, false, $sessionController);

        //Generar cálculos del carrito de compras
        $this->getTotals();
    }

    public function changeAddressSelectionType(int $addressSelectionType) {
        //Cambiar tipo de dirección (Nueva / Existente)
        $this->addressSelectionType = $addressSelectionType;
    }

    public function getCountUserAddresses(int $catalogCountryId) {
        //Obtener la cantidad de direcciones registradas por el usuario
        $this->countUserAddresses = auth()->user()->userAddresses()
        ->catalogCountryId($catalogCountryId)
        ->status()
        ->count();
    }

    public function updatedStateUserAddressForm() {
        //Actualizar estado en el formulario de dirección
        $this->userAddressForm->state = $this->stateUserAddressForm;

        //Limpiar información
        $this->municipalityUserAddressForm = '';

        //Limpiar información en el formulario de dirección
        $this->userAddressForm->municipality = '';
        $this->userAddressForm->colony = '';
        $this->userAddressForm->catalogMunicipalities = [];
        $this->userAddressForm->catalogColonies = [];

        //Obtener catálogo de municipios en el formulario de dirección
        $this->userAddressForm->getApiCatalogMunicipalities();
    }

    public function updatedMunicipalityUserAddressForm() {
        //Actualizar municipio en el formulario de dirección
        $this->userAddressForm->municipality = $this->municipalityUserAddressForm;

        //Limpiar información en el formulario de dirección
        $this->userAddressForm->colony = '';
        $this->userAddressForm->catalogColonies = [];

        if (in_array($this->userAddressForm->catalogCountry['id'], [ 3, 4, 5, 8, 10 ])) {
            //Obtener catálogo de colonias en el formulario de dirección
            $this->userAddressForm->getApiCatalogColonies();
        }
    }

    public function updatedPostalCodeUserAddressForm() {
        if ($this->userAddressForm->catalogCountry['id'] == 2) {
            //Validar información
            $this->validate([ 'postalCodeUserAddressForm' => 'required|string|max:5|min:5' ], [], [ 'postalCodeUserAddressForm' => 'código postal' ]);

            //Actualizar código postal en el formulario de dirección
            $this->userAddressForm->postalCode = $this->postalCodeUserAddressForm;

            //Limpiar información en el formulario de dirección
            $this->userAddressForm->state = '';
            $this->userAddressForm->municipality = '';
            $this->userAddressForm->colony = '';
            $this->userAddressForm->catalogStates = [];
            $this->userAddressForm->catalogMunicipalities = [];
            $this->userAddressForm->catalogColonies = [];

            //Obtener catálogo de estados, municipios y colonias en el formulario de dirección
            $this->userAddressForm->getApiCatalogs();
        }
    }

    #[On('checkout.index.content.general.main.changeSelectedUserAddressExternal')]
    public function changeSelectedUserAddressExternal(int $userAddressId) {
        //Validar información
        if ($userAddressId <= 0) { return; }

        //Guardar dirección seleccionada por el usuario
        $this->selectedUserAddress = $userAddressId;
    }

    public function getCatalogPaymentMethods(int $catalogCountryId) {
        //Obtener catálogo de formas de pago
        $this->catalogPaymentMethods = CatalogPaymentMethod::catalogCountryId($catalogCountryId)
        ->status()
        ->get()
        ->toArray();
    }
}

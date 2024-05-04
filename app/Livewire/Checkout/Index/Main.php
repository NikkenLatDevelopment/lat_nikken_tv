<?php

namespace App\Livewire\Checkout\Index;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Livewire\Forms\CartForm;
use App\Models\SessionController;
use App\Models\CatalogPaymentMethod;
use App\Livewire\Forms\UserAddressForm;

class Main extends Component
{
    #[Locked]
    public int $countUserAddresses = 0;

    #[Locked]
    public ?int $selectedUserAddress = null;

    #[Locked]
    public array $catalogPaymentMethods = [];

    public bool $discountSuggestedPrice = false;
    public ?int $selectedCatalogPaymentMethod = null;
    public int $addressSelectionType = 0;

    public CartForm $cartForm;
    public UserAddressForm $userAddressForm;

    public string $stateUserAddressForm;
    public string $municipalityUserAddressForm;
    public int $postalCodeUserAddressForm;

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.main');
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

    #[On('checkout.index.main.removeProduct')]
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

    #[On('checkout.index.main.removeProductExternal')]
    public function removeProductExternal(int $productId, SessionController $sessionController) {
        //Eliminar producto del carrito de compras
        $validate = $this->cartForm->remove($productId, false, $sessionController);

        if ($validate) {
            //Generar cálculos del carrito de compras
            $this->getTotals();
        }
    }

    #[On('checkout.index.main.changeQuantityProduct')]
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

    #[On('checkout.index.main.updatedDiscountSuggestedPriceExternal')]
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

    #[On('checkout.index.main.changeSelectedUserAddressExternal')]
    public function changeSelectedUserAddressExternal(int $addressId) {
        //Validar información
        if ($addressId <= 0) { return; }

        //Guardar dirección seleccionada por el usuario
        $this->selectedUserAddress = $addressId;
    }

    public function getCatalogPaymentMethods(int $catalogCountryId) {
        //Obtener catálogo de formas de pago //TODO: !!!! Pendiente
        $this->catalogPaymentMethods = CatalogPaymentMethod::select('id', 'name')
        ->catalogCountryId($catalogCountryId)
        ->status()
        ->get()
        ->toArray();
    }

    public function save() {
        //TODO: !!!! Pendiente
        //Limpiar mensajes de error
        $this->resetErrorBag();

        if ($this->addressSelectionType == 0) {
            //Validar información del formulario de dirección
            $this->userAddressForm->validateAddress();
        } else if ($this->selectedUserAddress <= 0) {
            //Mostrar mensaje de error
            $this->addError('checkoutAddress.error', 'Selecciona una dirección para continuar.'); return;
        }

        if ($this->selectedCatalogPaymentMethod <= 0) {
            //Mostrar mensaje de error
            $this->addError('checkoutPayment.error', 'Selecciona una forma de pago para continuar.'); return;
        }

        if ($this->addressSelectionType == 0) {
            //Guardar dirección del usuario
            auth()->user()->userAddresses()->create([
                'catalog_country_id' => $this->userAddressForm->catalogCountry['id'],
                'name' => $this->userAddressForm->addressee,
                'phone' => $this->userAddressForm->phone,
                'email' => $this->userAddressForm->email,
                'cellphone' => $this->userAddressForm->cellphone,
                'address' => $this->userAddressForm->address,
                'complement_address' => $this->userAddressForm->complementAddress,
                'reference_address' => $this->userAddressForm->referenceAddress,
                'state' => explode('|', $this->userAddressForm->state)[1],
                'state_code' => explode('|', $this->userAddressForm->state)[0],
                'municipality' => explode('|', $this->userAddressForm->municipality)[1],
                'municipality_code' => explode('|', $this->userAddressForm->municipality)[0],
                'colony' => explode('|', $this->userAddressForm->colony)[1] ?? null,
                'colony_code' => explode('|', $this->userAddressForm->colony)[0] ?? null,
                'postal_code' => $this->userAddressForm->postalCode,
                'status' => $this->userAddressForm->saveNewAddress ? 1 : 2
            ]);
        }

        //Sumar el subtotal de todos los productos
        $totalSubtotalProducts = array_sum(array_column($this->cartForm->products, 'subtotal'));

        //Sumar el retail de todos los productos
        $totalRetailProducts = array_sum(array_column($this->cartForm->products, 'retail'));

        //Sumar el IVA del retail de todos los productos
        $totalVatRetailProducts = array_sum(array_column($this->cartForm->products, 'vatRetail'));

        //Sumar el IVA de todos los productos
        $totalVatProducts = array_sum(array_column($this->cartForm->products, 'vat'));

        //Guardar información de la compra
        $sale = auth()->user()->sales()->create([
            'catalog_country_id' => $this->userAddressForm->catalogCountry['id'],
            'catalog_price_list_id' => $this->discountSuggestedPrice ? 2 : 1,
            'subtotal' => $totalSubtotalProducts,
            'discount' => $this->cartForm->discountSuggestedPrice ? $totalRetailProducts : 0,
            'iva' => $this->cartForm->discountSuggestedPrice ? ($totalVatProducts - $totalVatRetailProducts) : $totalVatProducts,
            'total' => $this->cartForm->discountSuggestedPrice ? (($totalSubtotalProducts - $totalRetailProducts) + ($totalVatProducts - $totalVatRetailProducts)) : ($totalSubtotalProducts + $totalVatProducts)
        ]);

        foreach ($this->cartForm->products as $product) {
            //Guardar producto
            $sale->saleProducts()->create([
                'product_id' => $product['id'],
                'quantity' => $product['quantity']
            ]);
        }

        //Obtener información de la forma de pago seleccionada
        $catalogPaymentMethod = CatalogPaymentMethod::select('id', 'name', 'redirect_to')->find($this->selectedCatalogPaymentMethod);

        if (!$catalogPaymentMethod) {
            //Redireccionar
            return redirect()->route('home');
        }

        dd($catalogPaymentMethod->redirect_to . '/auth/' . urlencode(Crypt::encryptString($sale->id . '|' . now()->toDateTimeString())));
    }
}

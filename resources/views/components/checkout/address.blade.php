<h2 class="h2 text-dark fw-bold lh-1 mb-0">Dirección de Envío</h2>
<p class="mb-4">Aquí recibirás @choice('tu producto|tus <span class="text-success fw-bold">'  . $this->cartForm->quantity .' productos</span>', $this->cartForm->quantity)  NIKKEN.</p>

<ul class="nav nav-pills my-3" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up active" id="checkout-address-form-tab" data-bs-toggle="pill" data-bs-target="#checkout-address-form" type="button" role="tab" aria-controls="checkout-address-form" aria-selected="true">
            <i class="fi fi-sr-map-pin position-relative custom i-top-2 me-1"></i>Nueva Dirección
        </button>
    </li>

    @if ($this->addressForm->totalAddresses > 0)
        <li class="nav-item" role="presentation">
            <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up" id="checkout-address-table-tab" data-bs-toggle="pill" data-bs-target="#checkout-address-table" type="button" role="tab" aria-controls="checkout-address-table" aria-selected="false">
                <i class="fi fi-br-search position-relative custom i-top-2 me-2"></i>Direcciones Existentes
            </button>
        </li>
    @endif
</ul>

<div class="tab-content border-top border-secondary pt-4">
    <div class="tab-pane fade show active" id="checkout-address-form" role="tabpanel" aria-labelledby="checkout-address-form-tab" tabindex="0">
        <x-checkout.address-country />
    </div>

    @if ($this->addressForm->totalAddresses > 0)
        <div class="tab-pane fade" id="checkout-address-table" role="tabpanel" aria-labelledby="checkout-address-table-tab" tabindex="0">
            @livewire('checkout.index.table.address')
        </div>
    @endif
</div>

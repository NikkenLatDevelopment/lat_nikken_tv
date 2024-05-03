<h2 class="h2 text-dark fw-bold lh-1 mb-0">Dirección de Envío</h2>

<ul class="nav nav-pills mt-3 mb-1" role="tablist">
    <li class="nav-item" role="presentation" wire:click="changeAddressSelectionType(0)">
        <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up active" id="checkout-address-form-tab" data-bs-toggle="pill" data-bs-target="#checkout-address-form" type="button" role="tab" aria-controls="checkout-address-form" aria-selected="true" wire:ignore>
            <i class="fi fi-sr-map-pin position-relative custom i-top-2 me-1"></i>Nueva Dirección
        </button>
    </li>

    @if ($this->countUserAddresses > 0)
        <li class="nav-item" role="presentation" wire:click="changeAddressSelectionType(1)">
            <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up" id="checkout-address-table-tab" data-bs-toggle="pill" data-bs-target="#checkout-address-table" type="button" role="tab" aria-controls="checkout-address-table" aria-selected="false" wire:ignore>
                <i class="fi fi-br-search position-relative custom i-top-2 me-2"></i>Direcciones Existentes
            </button>
        </li>
    @endif
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="checkout-address-form" role="tabpanel" aria-labelledby="checkout-address-form-tab" tabindex="0" wire:ignore.self>
        <div class="pt-2"><x-checkout.address.form /></div>
    </div>

    @if ($this->countUserAddresses > 0)
        <div class="tab-pane fade" id="checkout-address-table" role="tabpanel" aria-labelledby="checkout-address-table-tab" tabindex="0" wire:ignore.self>
            @livewire('checkout.index.table.address')
        </div>
    @endif
</div>

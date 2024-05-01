<div>
    <div class="fw-bold">Selecciona una dirección para continuar.</div>
    <div class="small mb-3">Si deseas actualizar la información de alguna de las direcciones, debes dirigirte a tu cuenta, sección mis direcciones.</div>

    <div class="input-group border border-1 border-secondary rounded-3 mb-3">
        <div class="form-floating">
            <input type="text" class="form-control bg-transparent border-0 shadow-none" id="checkout-index-table-address-search" wire:model.live.debounce.500ms="search" placeholder="Buscar..." autocomplete="off">
            <label for="checkout-index-table-address-search" class="text-muted">Buscar...</label>
        </div>

        <button type="submit" class="btn btn-link text-decoration-none border-0 rounded-0 pe-3"><i class="fi fi-rr-search h5 position-relative custom i-top-1"></i></button>
    </div>

    <div class="row gx-3 row-cols-1 row-cols-sm-2">
        @foreach ($userAddresses as $index => $userAddress)
            <div class="col">
                <label class="form-check-label d-flex align-items-stretch h-100" for="checkout-index-table-address-{{ $index }}">
                    <div class="bg-light border border-light rounded-4 w-100 px-4 py-3 mb-3">
                        <div class="form-check form-switch d-flex align-items-center mb-3 pb-1">
                            <input type="radio" class="form-check-input" name="checkout-index-table-address" role="switch" id="checkout-index-table-address-{{ $index }}">
                            <div class="h6 text-dark fw-bold mb-0 mt-1 ms-2">{{ $userAddress->alias }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="h6 text-muted fw-bold lh-1 mb-1 pb-1">{{ $userAddress->name }}</div>
                            <div class="small lh-1 mb-1"><span class="h6 small text-muted fw-bold mb-0">Correo:</span> {{ $userAddress->email }}</div>
                            <div class="small"><span class="h6 small text-muted fw-bold mb-0">Teléfono:</span> {{ formatContactInfo($userAddress->cellular, $userAddress->phone) }}</div>
                        </div>

                        <div class="h6 small text-muted fw-bold lh-1 mb-1">Dirección:</div>
                        <p class="mb-1">{{ formatAddressInfo($userAddress->address, $userAddress->state, $userAddress->municipality, $userAddress->complement_address, $userAddress->reference_address, $userAddress->colony, $userAddress->postal_code) }}</p>
                    </div>
                </label>
            </div>
        @endforeach
    </div>

    @if ($userAddresses->hasPages()) <div>{{ $userAddresses->onEachSide(1)->links(data: [ 'scrollTo' => '#addresses' ]) }}</div> @endif
</div>

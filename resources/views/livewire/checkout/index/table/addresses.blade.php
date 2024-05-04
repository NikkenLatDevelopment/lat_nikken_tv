<div>
    <div class="fw-bold">Selecciona una dirección para continuar.</div>
    <div class="small mb-3">Si necesitas actualizar la información de tus direcciones, dirígete a tu cuenta, sección <a href="#">mis direcciones</a>.</div>

    <div class="input-group border border-1 border-secondary rounded-3 mb-3">
        <div class="form-floating">
            <input type="text" class="form-control bg-transparent border-0 shadow-none" id="checkout-index-table-addresses-search" wire:model.live.debounce.500ms="search" placeholder="Buscar..." autocomplete="off">
            <label for="checkout-index-table-addresses-search" class="text-muted">Buscar...</label>
        </div>

        <button type="button" class="btn btn-link text-decoration-none border-0 rounded-0 pe-3"><i class="fi fi-rr-search h5 position-relative custom i-top-1"></i></button>
    </div>

    <div class="pt-1" x-data="{ selectedUserAddress: null }">
        <div class="row gx-3 row-cols-1 row-cols-md-2">
            @forelse ($userAddresses as $index => $userAddress)
                <div class="col" wire:key="checkout-index-table-addresses-{{ $userAddress->id }}">
                    <label class="form-check-label d-flex align-items-stretch h-100" for="checkout-index-table-addresses-{{ $userAddress->id }}">
                        <div class="bg-light border rounded-4 d-flex align-items-center w-100 px-4 py-3 mb-3" :class="selectedUserAddress === {{ $userAddress->id }} ? 'border-success' : 'border-light'">
                            <div>
                                <div class="form-check form-switch d-flex align-items-center mb-2">
                                    <input type="radio" class="form-check-input" name="checkout-index-table-addresses" role="switch" id="checkout-index-table-addresses-{{ $userAddress->id }}" wire:click="$dispatch('checkout.index.main.changeSelectedUserAddressExternal', { addressId: {{ $userAddress->id }} })" @change="selectedUserAddress =  {{ $userAddress->id }}" value="{{ $userAddress->id }}">
                                    <div class="h6 text-dark fw-bold mb-0 mt-1 ms-2">{{ $userAddress->name }}</div>
                                </div>

                                <div class="small"><span class="h6 small text-muted fw-bold mb-0">Correo:</span> {{ $userAddress->email }}</div>
                                <div class="small"><span class="h6 small text-muted fw-bold mb-0">Teléfono:</span> {{ formatAddressPhone($userAddress->cellphone, $userAddress->phone) }}</div>
                                <div class="small"><span class="h6 small text-muted fw-bold mb-0">Dirección:</span> {{ formatAddressInfo($userAddress->address, $userAddress->state, $userAddress->municipality, $userAddress->complement_address, $userAddress->reference_address, $userAddress->colony, $userAddress->postal_code) }}</div>
                            </div>
                        </div>
                    </label>
                </div>
            @empty
                <div class="col">
                    <div class="bg-light border border-light rounded-4 w-100 px-4 py-3 mb-3">
                        No se encontraron resultados con "<span class="text-dark fw-bold">{{ $search }}</span>"
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if ($userAddresses->hasPages()) <div>{{ $userAddresses->onEachSide(1)->links(data: [ 'scrollTo' => '#addresses' ]) }}</div> @endif
</div>

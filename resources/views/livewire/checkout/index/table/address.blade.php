<div>
    <div class="row gx-3 row-cols-2">
        @foreach ($userAddresses as $index => $userAddress)
            <div class="col">
                <label class="form-check-label d-flex align-items-stretch h-100" for="checkout-index-table-address-{{ $index }}">
                    <div class="bg-light border border-light rounded-4 w-100 px-4 py-3 mb-3">
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                            <input type="radio" class="form-check-input" name="checkout-index-table-address" role="switch" id="checkout-index-table-address-{{ $index }}">
                            <div class="h6 text-dark fw-bold mb-0 mt-1 ms-2">{{ $userAddress->alias }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="h6 text-muted fw-bold lh-sm mb-1">{{ $userAddress->name }}</div>
                            <div class="small lh-1 mb-1">{{ $userAddress->email }}</div>
                            <div class="small">{{ formatContactInfo($userAddress->cellular, $userAddress->phone) }}</div>
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

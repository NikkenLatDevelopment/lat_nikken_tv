<div>
    @foreach ($catalogCountries as $catalogCountry)
        <div class="d-inline-block d-lg-block my-2 mx-1" wire:key="catalog-country-{{ $catalogCountry['id'] }}">
            <div class="bg-light rounded-3 d-inline-block">
                <button type="button" class="btn btn-link link-dark d-flex align-items-center" wire:click="update({{ $catalogCountry['id'] }})" wire:loading.attr="disabled">
                    <img src="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '.png') }}" srcset="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '-2x.png') }} 2x" class="img-fluid" alt="Bandera de {{ $catalogCountry['name'] }}">
                    <span class="fw-semibold ms-2 ps-1">{{ $catalogCountry['name'] }}</span>

                    <span class="ms-2" wire:loading wire:target="update({{ $catalogCountry['id'] }})">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </button>
            </div>
        </div>
    @endforeach
</div>

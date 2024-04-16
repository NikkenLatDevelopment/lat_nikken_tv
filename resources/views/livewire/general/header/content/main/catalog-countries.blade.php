<div>
    <div class="dropdown country">
        <button class="btn btn-sm btn-link dropdown-toggle link-success text-decoration-none lh-1 d-flex align-items-center p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/img/countries/' . $country['code'] . '.png') }}" srcset="{{ asset('assets/img/countries/' . $country['code'] . '-2x.png') }} 2x" class="img-fluid me-2" alt="Bandera de {{ $country['name'] }}"> <span class="position-relative name">{{ $country['name'] }}</span>
        </button>

        <ul class="dropdown-menu overflow-hidden animate__animated animate__fadeIn animate__faster">
            <li><h6 class="dropdown-header fw-bold opacity-75">País de Residencia</h6></li>

            @foreach ($catalogCountries as $catalogCountry)
                @if ($catalogCountry['id'] != $country['id'])
                    <li>
                        <a href="{{ route('country.update', $catalogCountry['id']) }}" class="dropdown-item d-flex align-items-center">
                            <img src="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '.png') }}" srcset="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '-2x.png') }} 2x" class="img-fluid me-2" alt="Bandera de {{ $catalogCountry['name'] }}"> {{ $catalogCountry['name'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

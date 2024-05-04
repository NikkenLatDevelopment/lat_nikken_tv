<div>
    <div class="dropdown country">
        <button type="button" class="btn btn-sm btn-link dropdown-toggle link-success text-decoration-none lh-1 d-flex align-items-center p-0" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '.png') }}" srcset="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '-2x.png') }} 2x" class="img-fluid me-2" alt="Bandera de {{ $catalogCountry['name'] }}"> <span class="position-relative name">{{ $catalogCountry['name'] }}</span>
        </button>

        <ul class="dropdown-menu overflow-hidden animate__animated animate__fadeIn animate__faster">
            <li><h6 class="dropdown-header opacity-75 fw-bold">País de Residencia</h6></li>

            @foreach ($catalogCountries as $catalogCountry)
                <li>
                    <a href="{{ route('country.update', $catalogCountry['id']) }}" class="dropdown-item d-flex align-items-center">
                        <img src="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '.png') }}" srcset="{{ asset('assets/img/countries/' . $catalogCountry['code'] . '-2x.png') }} 2x" class="img-fluid me-2" alt="Bandera de {{ $catalogCountry['name'] }}"> {{ $catalogCountry['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@extends('layouts.app')
@section('title', 'Selecciona tu país')
@push('SEO') <meta name="robots" content="noindex, nofollow, noarchive"> @endpush

@section('content')
    @push('styles') @vite([ 'resources/sass/app.scss' ]) @endpush

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-auto">
                <div class="row justify-content-center align-items-center my-4">
                    <div class="col-12 col-lg text-center">
                        <div class="px-3 mb-4 mb-lg-0">
                            <img src="{{ asset('assets/img/general/logo-big.png') }}" srcset="{{ asset('assets/img/general/logo-big-2x.png') }} 2x" class="img-fluid" alt="Mi Tienda NIKKEN">
                        </div>
                    </div>

                    <div class="col-auto text-center text-lg-start">
                        @livewire('country.index.content.catalog-countries')
                        @livewire('country.index.modal.closing-message')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

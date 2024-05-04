@extends('layouts.app')
@section('title', 'Inicio de Sesión')
@push('SEO') <!-- TODO: !!!! Pendiente --> @endpush

@section('content')
    @push('styles') @vite([ 'resources/sass/auth.scss' ]) @endpush

    <x-general.header.content />

    <div class="checkout">
        <div class="border-bottom border-secondary">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23c7c7c7'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb my-3 py-1">
                                <li class="breadcrumb-item me-2"><a href="{{ route('home') }}" class="h6 small link-success fw-semibold">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="h6 small text-primary fw-semibold ms-2">Inicio de Sesión</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 signin">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-lg-auto"><img src="{{ asset('assets/img/resources/bg-login-1.png') }}" srcset="{{ asset('assets/img/resources/bg-login-1-2x.png') }} 2x" class="img-fluid rounded-4 d-none d-lg-inline-block me-3" alt="Iniciar Sesión"></div>

                    <div class="col-12 col-lg-auto">
                        <h1 class="text-dark fw-bold lh-1 mb-0">Iniciar Sesión</h1>
                        <p class="mb-4">Si aún no tienes una cuenta, <a href="#" class="link-success">regístrate aquí</a>.</p>

                        @livewire('auth.index.content.signin')

                        <div class="fw-bold mt-5">¿No recuerdas tu contraseña?</div>
                        <div>Recupérala <a href="#" class="link-success">aquí</a>.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-general.footer.content />
@endsection

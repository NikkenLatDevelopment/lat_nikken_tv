@extends('layouts.app')
@section('title', 'Checkout')
@push('SEO') <meta name="robots" content="noindex, nofollow, noarchive"> @endpush

@section('content')
    @push('styles') @vite([ 'resources/sass/checkout.scss' ]) @endpush

    <x-general.header.content />

    <div class="checkout">
        <div class="border-bottom border-secondary">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23c7c7c7'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb my-3 py-1">
                                <li class="breadcrumb-item me-2"><a href="{{ route('home') }}" class="h6 small link-success fw-semibold">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="h6 small text-primary fw-semibold ms-2">Checkout</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @livewire('checkout.index.main')
    </div>

    <x-general.footer.content />
@endsection

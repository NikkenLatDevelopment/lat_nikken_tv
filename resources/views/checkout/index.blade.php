@extends('layouts.app')
@section('title', 'Checkout')
@push('SEO') <meta name="robots" content="noindex, nofollow, noarchive"> @endpush

@section('content')
    @push('styles') @vite([ 'resources/sass/checkout.scss' ]) @endpush

    <x-general.header.content.main />

    <div class="checkout">
    </div>

    <x-general.footer.content.main />
@endsection

@extends('layouts.app')
@section('title', $product['name'])
@push('SEO') <!-- TODO: !!!! Pendiente --> @endpush

@section('content')
    @push('styles') @vite([ 'resources/sass/product.scss' ]) @endpush

    <x-general.header.content />

    <div class="product">
        @livewire('product.show.main', [ 'product' => $product ])
        @livewire('product.show.modal.available-message')
        @livewire('product.show.modal.share')
        @livewire('product.show.modal.technology-description')
        @livewire('product.show.modal.review')
    </div>

    <x-general.footer.content />

    @push('scripts') @vite([ 'resources/js/product.js' ]) @endpush
@endsection

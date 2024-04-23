@extends('layouts.app')
@section('title', $product->name)

@push('SEO')
    <!-- TODO: !!!! Pendiente -->
    <!-- TODO: !!!! Pendiente -->
@endpush

@section('content')
    @push('styles') @vite([ 'resources/sass/product.scss' ]) @endpush

    <x-general.header.content.main />

    <div class="product">
        @livewire('product.show.content.main', [ 'product' => $product->toArray(), 'availability' => $availability ])
        @livewire('product.show.modal.available-message')
        @livewire('product.show.modal.share')
        @livewire('product.show.modal.technology-description')
    </div>

    @push('scripts') @vite(['resources/js/product.js']) @endpush
@endsection

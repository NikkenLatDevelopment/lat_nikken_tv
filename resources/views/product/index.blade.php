@extends('layouts.app')
@section('title', 'Buscar')
@push('SEO') <meta name="robots" content="noindex, nofollow, noarchive"> @endpush

@section('content')
    @push('styles') @vite([ 'resources/sass/app.scss' ]) @endpush

    <x-general.header.content />
    <div class="product"> @livewire('product.index.main', [ 'search' => $search ]) </div>
    <x-general.footer.content />
@endsection

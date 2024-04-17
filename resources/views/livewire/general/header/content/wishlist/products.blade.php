<div>
    <div class="products">
        @forelse ($products as $product)
            <div class="bg-white rounded-4 position-relative p-2 mb-2">
                <div class="position-absolute end-0 top-0"><button class="btn btn-link link-primary opacity-50 text-decoration-none" wire:click="removeProduct({{ $product['id'] }})"><i class="fi fi-br-trash"></i></button></div>

                <a href="{{ route('product.show', [ 'brandSlug' => $product['brandSlug'], 'productSlug' => $product['slug'] ]) }}" class="text-decoration-none">
                    <div class="row gx-3 align-items-center">
                        <div class="col-auto"><div class="bg-light rounded-4"><img src="{{ $product['image'] }}" class="img-fluid" alt="{{ $product['name'] }}"></div></div>

                        <div class="col text-truncate">
                            <div class="small mb-1"><x-product.rating-star :ratingTotal="$product['rating']" /></div>
                            <div class="h6 fw-semibold text-truncate lh-1 mb-0">{{ $product['name'] }}</div>

                            @if ($product['available'] == 1)
                                <div class="h6 small text-success fw-bold lh-sm mb-0">Disponible</div>
                            @else
                                <div class="h6 small text-warning fw-bold lh-sm mb-0">Entrega Postergada</div>
                            @endif

                            <div class="h5 fw-bold mb-0 mt-1">{{ $product['price'] }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="text-center d-flex align-items-center justify-content-center empty">
                <div>
                    <img src="{{ asset('assets/img/general/empty-product.png') }}" class="img-fluid" alt="Lista de Deseos">
                    <p class="h5 text-black-50 opacity-50 fw-bold mt-3 mb-0">Tu lista de deseos está vacia.</p>
                    <p class="small text-black-50 opacity-50 fw-semibold">Empieza agregrando un producto.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

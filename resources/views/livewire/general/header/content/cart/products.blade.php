<div>
    <div class="products">
        @forelse ($products as $index => $product)
            <div class="bg-white rounded-4 position-relative p-2 mb-2" wire:key="cart-product-{{ $product['id'] }}">
                <div class="position-absolute end-0 top-0"><button class="btn btn-link link-primary opacity-50 text-decoration-none" wire:click="removeProduct({{ $index }}, {{ $product['id'] }})"><i class="fi fi-br-trash"></i></button></div>

                <a href="{{ route('product.show', [ 'brandSlug' => $product['brandSlug'], 'productSlug' => $product['slug'] ]) }}" class="text-decoration-none">
                    <div class="row gx-3 align-items-center">
                        <div class="col-auto"><div class="bg-light rounded-4"><img src="{{ $product['image'] }}" class="img-fluid" alt="{{ $product['name'] }}"></div></div>

                        <div class="col text-truncate">
                            <div class="h6 fw-semibold text-truncate lh-1 mb-0 pe-5">{{ $product['name'] }}</div>

                            @if ($product['available'] == 1)
                                <div class="h6 small text-success fw-bold mb-0">Disponible</div>
                            @else
                                <div class="h6 small text-warning fw-bold mb-0">Entrega Postergada</div>
                            @endif

                            <div class="mt-1 lh-sm"><span class="text-black-50 opacity-75 fw-bold">{{ $product['quantity'] }} x</span> <span class="h5 fw-bold mb-0">{{ $product['price'] }}</span></div>
                            <div class="badge small text-black-50 opacity-50 text-start d-block p-0 m-0">Total: {{ $product['total'] }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="text-center d-flex align-items-center justify-content-center empty">
                <div>
                    <img src="{{ asset('assets/img/general/empty-product.png') }}" class="img-fluid" alt="Lista de Deseos">
                    <p class="h5 text-black-50 opacity-50 fw-bold mt-3 mb-0">Tu carrito de compras está vacio.</p>
                    <p class="small text-black-50 opacity-50 fw-semibold">Empieza agregrando un producto.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

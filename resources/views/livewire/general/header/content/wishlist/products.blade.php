<div>
    <div class="products">
        @forelse ($products as $product)
            <div class="bg-white rounded-4 position-relative p-2 mb-2">
                <div class="position-absolute end-0 top-0"><a href="#hola" class="btn btn-link link-primary opacity-50 text-decoration-none"><i class="fi fi-br-trash"></i></a></div>

                <a href="{{ $product['slug'] }}" class="text-decoration-none">
                    <div class="row gx-3 align-items-center">
                        <div class="col-auto"><div class="bg-light rounded-4"><img src="{{ $product['image'] }}" class="img-fluid" alt="{{ $product['name'] }}"></div></div>

                        <div class="col text-truncate">
                            <div class="small mb-1"><x-product.rating-star :ratingTotal="$product['rating']" /></div>
                            <div class="h6 fw-semibold text-truncate lh-1 mb-0">{{ $product['name'] }}</div>

                            @if ($product['available'] == 1)
                                <div class="small text-success fw-bold lh-sm">Disponible</div>
                            @else
                                <div class="small text-warning fw-bold lh-sm">Entrega Postergada</div>
                            @endif

                            <div class="h5 text-muted fw-bold mb-0 mt-1">{{ $product['price'] }}</div>
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

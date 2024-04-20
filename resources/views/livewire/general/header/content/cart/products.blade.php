<div>
    <div class="products">
        @forelse ($products as $index => $product)
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

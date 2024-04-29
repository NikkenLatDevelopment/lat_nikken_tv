<h1 class="text-dark fw-bold lh-1 mb-0">Resumen</h1>
<p class="mb-4">Tienes <span class="text-success fw-bold">{{ count($products) }} @choice('producto|productos', count($products))</span> en tu carrito de compras.</p>

<div class="mb-3">
    <div class="row">
        <div class="col">
            <div class="bg-light rounded-3 p-3">
                <div class="row">
                    <div class="col-5"><span class="h6 fw-bold mb-0">Producto</span></div>
                    <div class="col"><span class="h6 fw-bold mb-0">Precio</span></div>
                    <div class="col"><span class="h6 fw-bold mb-0">Cantidad</span></div>
                    <div class="col"><span class="h6 fw-bold mb-0">Total</span></div>
                    <div class="col-auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </div>
            </div>

            <div class="products mt-2 pt-1">
                @foreach ($products as $product)
                    <div class="border-bottom border-secondary mb-2 pb-2" wire:key="checkout-resume-{{ $product['id'] }}">
                        @livewire('checkout.index.content.resume-product', [ 'productId' => $product['id'], 'product' => $product ], key('checkout-index-content-resume-product-' . $product['id']))
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-3"></div>
    </div>
</div>
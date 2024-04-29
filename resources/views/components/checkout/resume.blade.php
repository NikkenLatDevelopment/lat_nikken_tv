<h1 class="text-dark fw-bold lh-1 mb-0">Resumen</h1>
<p class="mb-4">Tienes <span class="text-success fw-bold">{{ $this->cartForm->quantity }} @choice('producto|productos', $this->cartForm->quantity)</span> en tu carrito de compras.</p>

<div class="bg-light rounded-3 p-3">
    <div class="row">
        <div class="col-5"><span class="h6 fw-bold mb-0">Producto</span></div>
        <div class="col-2"><span class="h6 fw-bold d-none d-md-inline-block mb-0">Precio</span></div>
        <div class="col-2"><span class="h6 fw-bold d-none d-md-inline-block mb-0">Cantidad</span></div>
        <div class="col-2"><span class="h6 fw-bold d-none d-md-inline-block mb-0">Total</span></div>
        <div class="col-1"></div>
    </div>
</div>

<div class="products mt-2 pt-1">
    @foreach ($this->cartForm->products as $product)
        <div class="border-bottom border-secondary mb-2 pb-2" wire:key="checkout-resume-{{ $product['id'] }}">
            @livewire('checkout.index.content.resume-product', [ 'productId' => $product['id'], 'product' => $product ], key('checkout-index-content-resume-product-' . $product['id']))
        </div>
    @endforeach
</div>


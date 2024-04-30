<h1 class="text-dark fw-bold lh-1 mb-0">Checkout</h1>
<p class="mb-4">Tienes <span class="text-success fw-bold">{{ $this->cartForm->quantity }} @choice('producto|productos', $this->cartForm->quantity)</span> en tu carrito de compras.</p>

<div class="bg-light rounded-3 p-3">
    <div class="row">
        <div class="col-5"><span class="h6 fw-bold mb-0">Producto<span class="d-inline-block d-md-none">s</span></span></div>
        <div class="col-2"><span class="h6 fw-bold d-none d-md-inline-block mb-0">Precio</span></div>
        <div class="col-2"><span class="h6 fw-bold d-none d-md-inline-block mb-0">Cantidad</span></div>
        <div class="col-2"><span class="h6 fw-bold d-none d-md-inline-block mb-0">Total</span></div>
        <div class="col-1"></div>
    </div>
</div>

<div class="products">
    <hr class="text-secondary opacity-75">

    @foreach ($this->cartForm->products as $product)
        <div wire:key="checkout-resume-{{ $product['id'] }}">
            @livewire('checkout.index.content.resume-product', [ 'productId' => $product['id'], 'product' => $product ], key('checkout-index-content-resume-product-' . $product['id']))
        </div>

        <hr class="text-secondary opacity-75">
    @endforeach
</div>


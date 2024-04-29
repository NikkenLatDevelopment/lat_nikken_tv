<h1 class="text-dark fw-bold lh-1 mb-0">Resumen</h1>
<p class="mb-4">Tienes <span class="text-success fw-bold">{{ $this->cartForm->quantity }} @choice('producto|productos', $this->cartForm->quantity)</span> en tu carrito de compras.</p>

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
                @foreach ($this->cartForm->products as $product)
                    <div class="border-bottom border-secondary mb-2 pb-2" wire:key="checkout-resume-{{ $product['id'] }}">
                        @livewire('checkout.index.content.resume-product', [ 'productId' => $product['id'], 'product' => $product ], key('checkout-index-content-resume-product-' . $product['id']))
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-3">
            <div class="bg-white border border-light border-4 rounded-4 shadow-sm p-3">
                @if (auth()->check() && $this->cartForm->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                    <div class="mb-2">
                        <div class="form-check form-switch small pb-1">
                            <input type="checkbox" class="form-check-input" role="switch" id="cart-discount-suggested-price" wire:model.live="discountSuggestedPrice">
                            <label class="form-check-label" for="cart-discount-suggested-price">Comprar a <span class="text-success fw-bold text-decoration-underline">Sugerido con Descuento</span>.</label>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">Subtotal:</div>
                        <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->subtotalText }}</div>
                    </div>

                    @if (auth()->check() && $this->cartForm->discountSuggestedPrice && $this->cartForm->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">Descuento:</div>
                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->retailText }}</div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">IVA:</div>
                        <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->vatText }}</div>
                    </div>

                    <hr class="text-secondary opacity-75">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h6 text-dark fw-bold text-truncate mb-0">Total:</div>
                        <div class="h5 text-dark fw-bold mb-0">{{ $this->cartForm->totalText }}</div>
                    </div>

                    @if (auth()->check() && auth()->user()->catalog_user_type_id == 3)
                        <hr class="text-secondary opacity-75">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">Puntos:</div>
                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->pointsText }}</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">VC:</div>
                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->vcText }}</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">Retail:</div>
                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->retailText }}</div>
                        </div>
                    @endif
                </div>

                <hr class="text-secondary opacity-75">

                <a href="#" class="btn h6 text-white fw-bold w-100 mb-2 btn-success-custom-1">Finalizar Compra</a>
                <a href="#" class="btn h6 text-white fw-bold w-100 mb-0 btn-dark-custom-1">Continuar Comprando</a>
            </div>
        </div>
    </div>
</div>

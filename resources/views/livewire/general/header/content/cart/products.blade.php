<div>
    @if (count($products) > 0)
        <div class="products px-3 pt-2 height-1 @if (!auth()->check()) height-4 @else @if (auth()->user()->catalog_user_type_id != 3) height-3 @else @if ($country['id'] == 1 && $discountSuggestedPrice) height-1 @else height-2 @endif @endif @endif">
            @foreach ($products as $index => $product)
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

                                <div class="mt-1 lh-sm"><span class="text-black-50 opacity-75 fw-bold">{{ $product['quantity'] }} x</span> <span class="h5 fw-bold mb-0">{{ $product['priceText'] }}</span></div>
                                <div class="badge small text-black-50 opacity-50 text-start d-block p-0 m-0">Total: {{ $product['totalText'] }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="position-absolute start-0 end-0 bottom-0">
            @if (auth()->check() && $country['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                <div class="ps-3">
                    <div class="form-check form-switch small pb-1">
                        <input type="checkbox" class="form-check-input" role="switch" id="cart-discount-suggested-price" wire:model.live="discountSuggestedPrice">
                        <label class="form-check-label" for="cart-discount-suggested-price">Comprar a <span class="text-success fw-bold text-decoration-underline">Sugerido con Descuento</span>.</label>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-4 shadow-sm p-3 mx-2 mb-2 mt-1">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">Subtotal:</div>
                        <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $subtotalText }}</div>
                    </div>

                    @if (auth()->check() && $discountSuggestedPrice && $country['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">Descuento:</div>
                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $retailText }}</div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <div class="h6 small text-black-50 opacity-75 fw-bold text-truncate mb-0">IVA:</div>
                        <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $vatText }}</div>
                    </div>

                    <hr class="text-secondary opacity-75">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h6 text-dark fw-bold text-truncate mb-0">Total:</div>
                        <div class="h5 text-dark fw-bold mb-0">{{ $totalText }}</div>
                    </div>

                    @if (auth()->check() && auth()->user()->catalog_user_type_id == 3)
                        <div class="hstack gap-2">
                            <div class="ms-auto"><span class="small text-black-50 opacity-75">Puntos: <span class="fw-bold">{{ $pointsText }}</span></span></div>
                            <div class="vr"></div>
                            <div><span class="small text-black-50 opacity-75">VC: <span class="fw-bold">{{ $vcText }}</span></span></div>

                            @if ($country['id'] != 1 || !$discountSuggestedPrice)
                                <div class="vr"></div>
                                <div><span class="small text-black-50 opacity-75">Retail: <span class="fw-bold">{{ $retailText }}</span></span></div>
                            @endif
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn h6 text-white fw-bold w-100 mb-0 btn-success-custom-1">Finalizar Compra</button>
            </div>
        </div>
    @else
        <div class="text-center d-flex align-items-center justify-content-center empty">
            <div>
                <img src="{{ asset('assets/img/general/empty-product.png') }}" class="img-fluid" alt="Lista de Deseos">
                <p class="h5 text-black-50 opacity-50 fw-bold mt-3 mb-0">Tu carrito de compras está vacio.</p>
                <p class="small text-black-50 opacity-50 fw-semibold">Empieza agregrando un producto.</p>
            </div>
        </div>
    @endif
</div>

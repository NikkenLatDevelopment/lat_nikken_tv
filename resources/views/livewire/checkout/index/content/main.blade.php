<div>
    <div class="border-bottom border-secondary">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23c7c7c7'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb my-3 py-1">
                            <li class="breadcrumb-item me-2"><a href="{{ route('home') }}" class="h6 small link-success fw-semibold">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span class="h6 small text-primary fw-semibold ms-2">Checkout</span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg">
                    <section class="mt-4 resume">
                        <h1 class="text-dark fw-bold lh-1 mb-0">Checkout</h1>
                        <p class="mb-4">Tienes <span class="text-success fw-bold">{{ $cartForm->quantity }} @choice('producto|productos', $cartForm->quantity)</span> en tu carrito de compras.</p>

                        <x-checkout.resume />
                    </section>

                    <section class="mt-4 pt-4 address">
                        <h2 class="h2 text-dark fw-bold lh-1 mb-0">Dirección de Envío</h2>
                        <p class="mb-4">Aquí recibirás @choice('tu producto|tus <span class="text-success fw-bold">'  . $cartForm->quantity .' productos</span>', $cartForm->quantity)  NIKKEN.</p>

                        <ul class="nav nav-pills my-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up active" id="product-description-general-tab" data-bs-toggle="pill" data-bs-target="#product-description-general" type="button" role="tab" aria-controls="product-description-general" aria-selected="true">
                                    <i class="fi fi-sr-map-pin position-relative custom i-top-2 me-1"></i>Nueva Dirección
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up" id="product-description-maintenance-tab" data-bs-toggle="pill" data-bs-target="#product-description-maintenance" type="button" role="tab" aria-controls="product-description-maintenance" aria-selected="false">
                                    <i class="fi fi-br-search position-relative custom i-top-2 me-2"></i>Direcciones Existentes
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content border-top border-secondary pt-4">
                            <div class="tab-pane fade show active" id="product-description-general" role="tabpanel" aria-labelledby="product-description-general-tab" tabindex="0">
                                <x-checkout.address />
                            </div>

                            <div class="tab-pane fade" id="product-description-maintenance" role="tabpanel" aria-labelledby="product-description-maintenance-tab" tabindex="0">2</div>
                        </div>
                    </section>
                </div>

                <div class="col-12 col-lg-auto">
                    <div class="sticky-top total" wire:ignore.self>
                        <div class="pt-2 pt-lg-4 mt-0 mt-lg-2">
                            <div class="bg-white border border-light border-4 rounded-4 shadow-sm p-3">
                                @if (auth()->check() && $this->cartForm->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                                    <div class="mb-2">
                                        <div class="form-check form-switch small pb-1">
                                            <input type="checkbox" class="form-check-input" role="switch" id="checkout-discount-suggested-price" wire:model.live="discountSuggestedPrice">
                                            <label class="form-check-label" for="checkout-discount-suggested-price">Comprar a <span class="text-success fw-bold text-decoration-underline">Sugerido con Descuento</span>.</label>
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">Subtotal:</div>
                                        <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->subtotalText }}</div>
                                    </div>

                                    @if (auth()->check() && $this->cartForm->discountSuggestedPrice && $this->cartForm->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">Descuento:</div>
                                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->retailText }}</div>
                                        </div>
                                    @endif

                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">IVA:</div>
                                        <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->vatText }}</div>
                                    </div>

                                    <hr class="text-secondary opacity-75">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="h6 text-dark fw-bold mb-0">Total:</div>
                                        <div class="h5 text-dark fw-bold mb-0">{{ $this->cartForm->totalText }}</div>
                                    </div>

                                    @if (auth()->check() && auth()->user()->catalog_user_type_id == 3)
                                        <hr class="text-secondary opacity-75">

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">Puntos:</div>
                                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->pointsText }}</div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">VC:</div>
                                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->vcText }}</div>
                                        </div>

                                        @if ($cartForm->country['id'] != 1 || !$cartForm->discountSuggestedPrice)
                                            <div class="d-flex justify-content-between align-items-center mt-1">
                                                <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">Retail:</div>
                                                <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->retailText }}</div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <hr class="text-secondary opacity-75">

                                <a href="#" class="btn h6 text-white fw-bold w-100 mb-2 btn-success-custom-1">Finalizar Compra</a>
                                <a href="{{ route('product.index') }}" class="btn h6 text-white fw-bold w-100 mb-0 btn-dark-custom-1">Continuar Comprando</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

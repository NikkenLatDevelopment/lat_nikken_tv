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
                        <x-checkout.resume />
                    </section>

                    <section class="mt-4 pt-4 address" id="addresses">
                        <x-checkout.address />
                    </section>
                </div>

                <div class="col-12 col-lg-auto">
                    <div class="sticky-top total" wire:ignore.self>
                        <div class="pt-2 pt-lg-4 mt-0 mt-lg-2">
                            <div class="bg-white border border-light border-4 rounded-4 shadow-sm p-3">
                                @if (auth()->check() && $this->cartForm->country['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                                    <div class="mb-2">
                                        <div class="form-check form-switch small pb-1">
                                            <input type="checkbox" class="form-check-input" role="switch" id="checkout-index-content-main-discount-suggested-price" wire:model.live="discountSuggestedPrice">
                                            <label class="form-check-label" for="checkout-index-content-main-discount-suggested-price">Comprar a <span class="text-success fw-bold text-decoration-underline">Sugerido con Descuento</span>.</label>
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

                                <a href="#" class="btn h6 text-white fw-bold w-100 mb-2 btn-success-custom-1">Pagar {{ $this->cartForm->totalText }}</a>
                                <a href="#" class="btn h6 fw-bold w-100 mb-0 btn-outline-dark-custom-1">Generar Cotización</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

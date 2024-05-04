<div>
    <div class="mb-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg">
                    <section class="mt-4 resume">
                        <x-checkout.resume />
                    </section>

                    <section class="mt-4 pt-4 address" id="addresses">
                        <x-checkout.address />
                        <hr class="text-secondary opacity-75">
                    </section>

                    <section class="mt-4 pt-4 payment">
                        <x-checkout.payment />
                    </section>
                </div>

                <div class="col-12 col-lg-auto">
                    <div class="sticky-top total" wire:ignore.self>
                        <div class="pt-2 pt-lg-4 mt-0 mt-lg-2">
                            <div class="bg-white border border-light border-4 rounded-4 shadow-sm p-3">
                                <form wire:submit="save">
                                    @if (auth()->check() && $this->cartForm->catalogCountry['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
                                        <div class="mb-2">
                                            <div class="form-check form-switch small pb-1">
                                                <input type="checkbox" class="form-check-input" role="switch" id="checkout-index-main-discount-suggested-price" wire:model.live="discountSuggestedPrice">
                                                <label class="form-check-label" for="checkout-index-main-discount-suggested-price">Comprar a <span class="text-success fw-bold text-decoration-underline">Sugerido con Descuento</span>.</label>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">Subtotal:</div>
                                            <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->subtotalText }}</div>
                                        </div>

                                        @if (auth()->check() && $this->cartForm->discountSuggestedPrice && $this->cartForm->catalogCountry['id'] == 1 && auth()->user()->catalog_user_type_id == 3)
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

                                            @if ($cartForm->catalogCountry['id'] != 1 || !$cartForm->discountSuggestedPrice)
                                                <div class="d-flex justify-content-between align-items-center mt-1">
                                                    <div class="h6 small text-black-50 opacity-75 fw-bold mb-0">Retail:</div>
                                                    <div class="h6 text-black-50 opacity-75 fw-semibold mb-0">{{ $this->cartForm->retailText }}</div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    <hr class="text-secondary opacity-75">

                                    @if ($errors->any())
                                        <div class="alert alert-danger bg-white border border-2 border-danger rounded-4" role="alert">
                                            <h6 class="alert-heading text-danger fw-bold">Tienes información pendiente por diligenciar:</h6>

                                            <ul class="fa-ul mb-0 ms-4">
                                                @foreach ($errors->all() as $error)
                                                    <li class="text-danger"><span class="fa-li"><i class="fa-solid fa-angle-right fa-xs"></i></span> {{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <button type="submit" class="btn h6 text-white fw-bold w-100 mb-2 btn-success-custom-1">Pagar {{ $this->cartForm->totalText }}</button>
                                    <a href="#" class="btn h6 fw-bold w-100 mb-0 btn-outline-dark-custom-1">Generar Cotización</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

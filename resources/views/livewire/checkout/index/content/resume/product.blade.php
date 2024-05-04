<div>
    <div class="row align-items-center">
        <div class="col-12 col-sm-5 col-md-5">
            <div class="row gx-3 d-flex align-items-center justify-content-center">
                <div class="col-auto col-sm-12 col-md-auto">
                    <div class="text-start text-sm-center text-md-start">
                        <div class="bg-light rounded-4 d-inline-block d-md-none d-xl-inline-block"><img src="{{ $product['image'] }}" class="img-fluid" alt="{{ $product['name'] }}"></div>
                    </div>
                </div>

                <div class="col-auto col-sm">
                    <div class="text-start text-sm-center text-md-start information">
                        <div class="h6 text-dark fw-bold lh-1 mb-0 mt-2 mt-md-0">{{ $product['name'] }}</div>

                        <div class="mb-0">
                            @if ($product['available'] == 1) <div class="h6 small text-success fw-bold mb-0">Disponible</div>
                            @else <div class="h6 small text-warning fw-bold mb-0">Entrega Postergada</div> @endif
                        </div>

                        <div class="small text-black-50 opacity-50 lh-sm mt-2">Código: <span class="h6 small fw-bold mb-0">{{ $product['sku'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-5 col-md-6">
            <div class="text-center text-md-start">
                <div class="row gx-2 align-items-center">
                    <div class="col-12 col-md order-2 order-md-1"><span class="h6 small text-black-50 opacity-75 fw-bold d-md-none mb-0">Precio:</span> <span class="h6">{{ $product['priceText'] }}</span></div>

                    <div class="col-12 col-md order-1 order-md-2">
                        <hr class="text-secondary opacity-75 d-md-none">
                        <span class="h6 small text-black-50 opacity-75 fw-bold d-md-none me-1">Cantidad:</span>

                        <div class="border @if ($product['available'] == 0) border-warning @else border-success @endif border-2 rounded-2 d-inline-block py-0 py-xl-1 mx-auto mx-md-0 quantity" x-data="{ quantity: $wire.entangle('product.quantity').live }">
                            <div class="row gx-0 align-items-center">
                                <div class="col"><input type="number" class="form-control text-muted fw-bold text-center border-0 shadow-none px-0 ms-3 py-2" x-bind:value="quantity" wire:model.live="product.quantity" readonly></div>

                                <div class="col-auto">
                                    <div class="d-flex flex-column">
                                        <button type="button" class="btn btn-link @if ($product['available'] == 0) link-warning @else link-success @endif text-decoration-none lh-1 py-0 px-1" @click="quantity++" x-bind:disabled="quantity >= 99" wire:loading.attr="disabled"><i class="fi-rs-angle-small-up @if ($product['available'] == 0) text-warning @else text-success @endif"></i></button>
                                        <button type="button" class="btn btn-link @if ($product['available'] == 0) link-warning @else link-success @endif text-decoration-none lh-1 py-0 px-1" @click="quantity--" x-bind:disabled="quantity <= 1" wire:loading.attr="disabled"><i class="fi-rs-angle-small-down @if ($product['available'] == 0) text-warning @else text-success @endif"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="text-secondary opacity-75 d-md-none">
                    </div>

                    <div class="col-12 col-md order-3 order-md-3"><span class="h6 small text-black-50 opacity-75 fw-bold d-md-none mb-0">Total:</span> <span class="h5 @if ($product['available'] == 0) text-warning @else text-success @endif fw-bold mb-0">{{ $product['totalText'] }}</span></div>
                </div>
            </div>
        </div>

        <div class="col col-md-1">
            <div class="text-center text-md-start">
                <button class="btn btn-link link-primary opacity-50 text-decoration-none d-flex align-items-center mx-auto mt-1 pt-2 mt-md-0 pt-md-0" wire:click="$dispatch('checkout.index.main.removeProduct', { productId: {{ $product['id'] }} })"><i class="fi fi-br-trash"></i> <span class="small d-sm-none ms-1">Eliminar</span></button>
            </div>
        </div>
    </div>
</div>

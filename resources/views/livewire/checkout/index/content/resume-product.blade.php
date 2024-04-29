<div>
    <div class="row d-flex align-items-center">
        <div class="col-5">
            <div class="row gx-3 d-flex align-items-center">
                <div class="col-auto">
                    <div class="bg-light rounded-4"><img src="{{ $product['image'] }}" class="img-fluid" alt="{{ $product['name'] }}"></div>
                </div>

                <div class="col">
                    <div class="small text-black-50 opacity-50 mb-1">Código: <span class="h6 small fw-bold">{{ $product['sku'] }}</span></div>
                    <div class="h6 text-dark fw-bold mb-0">{{ $product['name'] }}</div>

                    @if ($product['available'] == 1)
                        <div class="h6 small text-success fw-bold mb-0">Disponible</div>
                    @else
                        <div class="h6 small text-warning fw-bold mb-0">Entrega Postergada</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col"><span class="h6">{{ $product['priceText'] }}</span></div>

        <div class="col">
            <div class="border @if ($product['available'] == 0) border-warning @else border-success @endif border-2 rounded-2 py-1 quantity">
                <div class="row gx-0 align-items-center" x-data="{ quantity: $wire.entangle('product.quantity').live }">
                    <div class="col"><input type="number" class="form-control text-muted fw-bold text-center border-0 shadow-none px-0 ms-2 ms-sm-3 py-2" x-bind:value="quantity" wire:model.live="product.quantity" readonly></div>

                    <div class="col-auto d-flex flex-column">
                        <button type="button" class="btn btn-link @if ($product['available'] == 0) link-warning @else link-success @endif text-decoration-none lh-1 py-0 px-1" @click="quantity++" x-bind:disabled="quantity >= 99" wire:loading.attr="disabled"><i class="fi-rs-angle-small-up @if ($product['available'] == 0) text-warning @else text-success @endif"></i></button>
                        <button type="button" class="btn btn-link @if ($product['available'] == 0) link-warning @else link-success @endif text-decoration-none lh-1 py-0 px-1" @click="quantity--" x-bind:disabled="quantity <= 1" wire:loading.attr="disabled"><i class="fi-rs-angle-small-down @if ($product['available'] == 0) text-warning @else text-success @endif"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col"><span class="h5 @if ($product['available'] == 0) text-warning @else text-success @endif fw-bold mb-0">{{ $product['totalText'] }}</span></div>
        <div class="col-auto"><button class="btn btn-link link-primary opacity-50 text-decoration-none" wire:click="$dispatch('checkout.index.content.main.removeProduct', { productId: {{ $product['id'] }} })"><i class="fi fi-br-trash"></i></button></div>
    </div>
</div>

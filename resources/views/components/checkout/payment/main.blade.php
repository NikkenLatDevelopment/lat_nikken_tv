<h2 class="h2 text-dark fw-bold lh-1 mb-0">Forma de Pago</h2>

<div class="mt-3">
    @foreach ($this->catalogPaymentMethods as $catalogPaymentMethod)
        <div wire:key="checkout-payment-main-{{ $catalogPaymentMethod['id'] }}">
            <div class="form-check form-switch">
                <input type="radio" class="form-check-input" name="checkout-payment-main" role="switch" id="checkout-payment-main-{{ $catalogPaymentMethod['id'] }}" wire:model.live="selectedcatalogPaymentMethod" value="{{ $catalogPaymentMethod['id'] }}">
                <label class="form-check-label" for="checkout-payment-main-{{ $catalogPaymentMethod['id'] }}">{{ $catalogPaymentMethod['name'] }}</label>
            </div>
        </div>
    @endforeach
</div>

@foreach ($measurements as $measurement)
    <div wire:key="measurement-{{ $measurement['product_id'] }}">
        <input
            type="radio"
            class="btn-check"
            name="product-measurement"
            id="product-measurement-{{ $measurement['product_id'] }}"
            wire:model.live="selectedMeasurement"
            wire:loading.attr="disabled"
            wire:target="addCart,selectedColor,selectedPresentation,selectedMeasurement,changeWishlist"
            value="{{ $measurement['product_id'] }}"
            autocomplete="off"
        >
        <label class="btn border-0 rounded-4 pb-2 btn-outline-success-custom-1" for="product-measurement-{{ $measurement['product_id'] }}">{{ $measurement['measurement'] }}</label>
    </div>
@endforeach

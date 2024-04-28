@foreach ($measurements as $measurement)
    <div wire:key="product-measurement-{{ $measurement['product_id'] }}">
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
        <label class="btn border-0 rounded-3 pb-2 @if ($available == 0 && ($measurement['product_id'] == $this->selectedMeasurement)) btn-outline-warning-custom-1 @else btn-outline-success-custom-1 @endif" for="product-measurement-{{ $measurement['product_id'] }}">{{ $measurement['measurement'] }}</label>
    </div>
@endforeach

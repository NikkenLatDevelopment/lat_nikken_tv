@foreach ($colors as $color)
    <div wire:key="product-color-{{ $color['product_id'] }}">
        <input
            type="radio"
            class="btn-check"
            name="product-color"
            id="product-color-{{ $color['product_id'] }}"
            wire:model.live="selectedColor"
            wire:loading.attr="disabled"
            wire:target="addCart,selectedColor,selectedPresentation,selectedMeasurement,changeWishlist"
            value="{{ $color['product_id'] }}"
            autocomplete="off"
        >
        <label class="btn border-0 rounded-3 pb-2 @if ($available == 0 && ($color['product_id'] == $this->selectedColor)) btn-outline-warning-custom-1 @else btn-outline-success-custom-1 @endif" for="product-color-{{ $color['product_id'] }}">{{ $color['color'] }}</label>
    </div>
@endforeach

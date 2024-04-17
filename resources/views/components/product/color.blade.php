@foreach ($colors as $color)
    <div wire:key="color-{{ $color['product_id'] }}">
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
        <label class="btn border-0 rounded-4 pb-2 btn-outline-success-custom-1" for="product-color-{{ $color['product_id'] }}">{{ $color['color'] }}</label>
    </div>
@endforeach

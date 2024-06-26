@foreach ($presentations as $presentation)
    <div wire:key="product-presentation-{{ $presentation['product_id'] }}">
        <input
            type="radio"
            class="btn-check"
            name="product-presentation"
            id="product-presentation-{{ $presentation['product_id'] }}"
            wire:model.live="selectedPresentation"
            wire:loading.attr="disabled"
            wire:target="addCart,selectedColor,selectedPresentation,selectedMeasurement,changeWishlist"
            value="{{ $presentation['product_id'] }}"
            autocomplete="off"
        >
        <label class="btn border-0 rounded-3 pb-2 @if ($available == 0 && ($presentation['product_id'] == $this->selectedPresentation)) btn-outline-warning-custom-1 @else btn-outline-success-custom-1 @endif" for="product-presentation-{{ $presentation['product_id'] }}">{{ $presentation['presentation'] }}</label>
    </div>
@endforeach

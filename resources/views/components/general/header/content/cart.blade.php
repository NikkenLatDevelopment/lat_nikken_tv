<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCartLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        @livewire('general.header.content.cart.products')
    </div>
</div>

@push('scripts')
    <script type="module">
        document.addEventListener('livewire:init', () => {
            Livewire.on('showCart', () => {
                showOffsetCanvas('#offcanvasCart');
            });
        });
    </script>
@endpush

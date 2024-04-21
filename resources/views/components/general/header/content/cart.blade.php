<div class="offcanvas offcanvas-end border-0 cart" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header shadow-sm p-4">
        <div class="offcanvas-title h5 text-dark fw-bold lh-1" id="offcanvasCartLabel">Carrito de Compras</div>
        <button type="button" class="btn-close me-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body bg-light p-0">
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

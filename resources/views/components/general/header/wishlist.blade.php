<div class="offcanvas offcanvas-end border-0 wishlist" tabindex="-1" id="offcanvasWishlist" aria-labelledby="offcanvasWishlistLabel">
    <div class="offcanvas-header shadow-sm p-4">
        <div class="offcanvas-title h5 text-dark fw-bold lh-1" id="offcanvasWishlistLabel">Lista de Deseos</div>
        <button type="button" class="btn-close me-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body bg-light p-3">
        @livewire('general.header.content.wishlist.products')
    </div>
</div>

@push('scripts')
    <script type="module">
        document.addEventListener('livewire:init', () => {
            Livewire.on('showWishlist', () => {
                showOffsetCanvas('#offcanvasWishlist');
            });
        });
    </script>
@endpush

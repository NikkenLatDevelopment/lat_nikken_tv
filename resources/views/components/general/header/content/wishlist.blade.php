<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWishlist" aria-labelledby="offcanvasWishlistLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWishlistLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
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

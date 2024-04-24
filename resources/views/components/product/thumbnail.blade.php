<a href="{{ route('product.show', [ 'brandSlug' => $product['brandSlug'], 'productSlug' => $product['slug'] ]) }}" class="text-decoration-none">
    <div class="card border-secondary rounded-4 mb-3 animation-hover-up">
        <figure><img src="{{ $product['image'] }}" class="card-img-top img-fluid" alt="{{ $product['name'] }}" /></figure>

        <div class="card-body text-center py-0">
            <div class="small"><x-product.rating-star :ratingTotal="$product['rating']" /></div>
            <h3 class="card-title h6 link-dark fw-bold mb-1">{{ $product['name'] }}</h3>
        </div>

        <div class="card-footer text-center bg-transparent border-0 pb-3 mt-1">
            <div class="h5 text-success fw-bold lh-1 mb-0">{{ $product['price'] }}</div>
            <div class="small text-black-50 opacity-50 lh-sm">Código: <span class="h6 small fw-bold">{{ $product['sku'] }}</span></div>
        </div>
    </div>
</a>

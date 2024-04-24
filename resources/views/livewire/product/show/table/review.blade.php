<div>
    <div class="mb-3">
        <div class="pb-1 mb-1 reviews">
            @foreach ($reviews as $review)
                <div class="border border-light border-2 rounded-4 p-3 @if (!$loop->last) mb-2 @else mb-0 @endif">
                    <div class="row">
                        <div class="col"><div class="small mb-2"><x-product.rating-star :ratingTotal="$review->rating" /></div></div>
                        <div class="col-auto"><span class="small text-black-50 opacity-50">{{ formatDateToDDMMMYYYY($review->created_at) }}</span></div>
                    </div>

                    <div class="h6 fw-bold lh-1 mb-0">{{ $review->user->name }}</div>

                    <div class="d-flex mb-1">
                        <div class="small text-black-50 opacity-50 mb-0">{{ $review->user->catalogCountry->name }}</div>
                        <img src="{{ asset('assets/img/countries/' . $review->user->catalogCountry->code . '.png') }}" srcset="{{ asset('assets/img/countries/' . $review->user->catalogCountry->code . '-2x.png') }} 2x" class="img-fluid rounded-2 ms-1" alt="Bandera de {{ $review->user->catalogCountry->name }}">
                    </div>

                    <p class="mb-0">{{ $review->comment }}</p>
                </div>
            @endforeach
        </div>

        @if ($reviews->hasPages()) <div>{{ $reviews->onEachSide(1)->links(data: [ 'scrollTo' => '#reviews' ]) }}</div> @endif
    </div>
</div>

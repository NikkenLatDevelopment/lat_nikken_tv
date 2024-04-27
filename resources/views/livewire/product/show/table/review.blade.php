<div>
    <div class="mb-3">
        <div class="pb-1 mb-1 reviews">
            <div class="bg-light rounded-4 p-4 mb-2"><span class="text-muted fw-bold">¿Te ha gustado el producto?</span> Comparte tu experiencia y ayuda a otras personas a conocer más sobre este producto. <a @if (auth()->check()) href="#" wire:click.prevent="$dispatch('product.show.modal.review.initialize', { productId: {{ $productId }}, productName: '{{ $productName }}' })" @else href="{{ route('login') }}" @endif class="link-success fw-bold">Compartir Experiencia</a>.</div>

            @if (!empty($reviews))
                <ul class="fa-ul mb-3 pt-1 ms-4">
                    <li class="small text-black-50 opacity-75 lh-sm"><span class="fa-li"><i class="fa-solid fa-circle-info"></i></span>Las siguientes son experiencias personales de algunos de nuestros usuarios de producto, NIKKEN se reserva el derecho de interpretación y estas han sido suministradas bajo su consentimiento.</li>
                </ul>
            @endif

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

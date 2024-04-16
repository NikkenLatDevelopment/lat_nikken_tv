@php
    $ratingRound = floor($ratingTotal);
    $ratingDecimal = $ratingTotal - $ratingRound;
@endphp

<div>
    @for ($i = 0; $i < 5; $i++)
        @if ($i < $ratingRound) <i class="fi fi-sr-star text-warning"></i>
        @elseif ($i == $ratingRound && $ratingDecimal >= 0.5) <i class="fi fi-rr-star-sharp-half-stroke text-warning"></i>
        @else <i class="fi fi-sr-star text-secondary"></i> @endif
    @endfor
</div>

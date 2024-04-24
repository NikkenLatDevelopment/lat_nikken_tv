<div>
    <div class="bg-light rounded-4 px-4 pt-4 pb-1 mb-3">
        <div class="faqs">
            @forelse ($faqs as $faq)
                <div class="@if (!$loop->last) mb-4 @else mb-2 @endif">
                    <h3 class="h6 text-muted fw-bold mb-1">{{ $faq->question }}</h3>
                    <ul class="ps-3"><li>{{ $faq->answer }}</li></ul>
                </div>
            @empty
                <div>Sin preguntas ni respuestas en estos momentos.</div>
            @endforelse
        </div>
    </div>

    @if ($faqs->hasPages()) <div class="pt-1 mb-3">{{ $faqs->onEachSide(1)->links(data: [ 'scrollTo' => '#faqs' ]) }}</div> @endif
</div>

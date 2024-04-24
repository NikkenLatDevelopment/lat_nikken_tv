@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav>
            <ul class="pagination pagination-sm justify-content-end mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link opacity-50 border-top-0 border-bottom-0 border-start-0"><i class="fi fi-sr-angle-small-left position-relative custom i-top-2"></i> @lang('pagination.previous')</span>
                    </li>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        <li class="page-item">
                            <button dusk="previousPage" type="button" class="page-link text-black-50 border-top-0 border-bottom-0 border-start-0" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"><i class="fi fi-sr-angle-small-left position-relative custom i-top-2"></i> @lang('pagination.previous')</button>
                        </li>
                    @else
                        <li class="page-item">
                            <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link text-black-50 bg-white border-top-0 border-bottom-0 border-start-0" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"><i class="fi fi-sr-angle-small-left position-relative custom i-top-2"></i> @lang('pagination.previous')</button>
                        </li>
                    @endif
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        <li class="page-item">
                            <button dusk="nextPage" type="button" class="page-link text-black-50 border-top-0 border-bottom-0 border-end-0" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">@lang('pagination.next') <i class="fi fi-sr-angle-small-right position-relative custom i-top-2"></i></button>
                        </li>
                    @else
                        <li class="page-item">
                            <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link text-black-50 bg-white border-top-0 border-bottom-0 border-end-0" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">@lang('pagination.next') <i class="fi fi-sr-angle-small-right position-relative custom i-top-2"></i></button>
                        </li>
                    @endif
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link opacity-50 border-top-0 border-bottom-0 border-end-0">@lang('pagination.next') <i class="fi fi-sr-angle-small-right position-relative custom i-top-2"></i></span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>

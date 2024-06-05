<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="bg-success rounded-4 mt-4 p-5 title img" style="--bs-bg-opacity: .1;">
                    <h1 class="text-dark fw-bold text-capitalize lh-1 mb-0">{{ $search == '' ? 'Productos' : $search }}</h1>

                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23c7c7c7'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb mt-2 mb-0">
                            <li class="breadcrumb-item me-2"><a href="{{ route('home') }}" class="h6 small link-success fw-semibold">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span class="h6 small text-primary fw-semibold ms-2">Buscar</span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="products-search">
        <div class="row">
            <div class="col">
                <section class="mt-4 list">
                    <div class="mb-4">¡Hemos encontrado <span class="text-success fw-bold">{{ $products->total() }} productos</span>!</div>

                    @forelse ($products as $product)
                        <a href="{{ route('product.show', [ 'brandSlug' => $product->catalogProductBrand->slug, 'productSlug' => $product->slug ]) }}" class="link-dark text-decoration-none d-block mb-4 animation-hover-up">
                            <div class="row align-items-center">
                                <div class="col-auto"><div class="border border-secondary rounded-4"><figure class="mb-0"><img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->image }}" /></figure></div></div>

                                <div class="col">
                                    <h2 class="h4 fw-bold mb-1">{{ $product->name }}</h2>

                                    <div class="d-flex align-items-center pb-2">
                                        <x-product.rating-star :ratingTotal="$product->rating_total" />
                                        <div class="vr mx-2"></div>

                                        <span class="small text-black-50 opacity-75 me-1">Código:</span>
                                        <span class="h6 text-dark fw-bold mb-0">{{ $product->sku }}</span>
                                    </div>

                                    <div class="text-primary">{!! $product->short_description !!}</div>

                                    @if ($product->productColors->count() > 0 || $product->productPresentations->count() > 0 || $product->productMeasurements->count() > 0)
                                        <div class="mb-2">
                                            @if ($product->productColors->count() > 0)
                                                <div>
                                                    <span class="text-dark fw-bold me-1">Colores:</span>

                                                    @foreach ($product->productColors as $productColor)
                                                        @if ($loop->first) <span class="text-primary">{{ $productColor->color }}</span>
                                                        @elseif ($loop->last) <span class="text-primary"> y {{ $productColor->color }}</span>
                                                        @else <span class="text-primary">, {{ $productColor->color }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if ($product->productPresentations->count() > 0)
                                                <div>
                                                    <span class="text-dark fw-bold me-1">Presentaciones:</span>

                                                    @foreach ($product->productPresentations as $productPresentation)
                                                        @if ($loop->first) <span class="text-primary">{{ $productPresentation->presentation }}</span>
                                                        @elseif ($loop->last) <span class="text-primary"> y {{ $productPresentation->presentation }}</span>
                                                        @else <span class="text-primary">, {{ $productPresentation->presentation }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if ($product->productMeasurements->count() > 0)
                                                <div>
                                                    <span class="text-dark fw-bold me-1">Medidas:</span>

                                                    @foreach ($product->productMeasurements as $productMeasurement)
                                                        @if ($loop->first) <span class="text-primary">{{ $productMeasurement->measurement }}</span>
                                                        @elseif ($loop->last) <span class="text-primary"> y {{ $productMeasurement->measurement }}</span>
                                                        @else <span class="text-primary">, {{ $productMeasurement->measurement }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="h3 text-success fw-bold mb-0">{{ $product->price }}</div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="alert alert-warning bg-warning border border-2 border-warning rounded-3 mb-0" style="--bs-bg-opacity: .1;">No se encontraron productos con la palabra <span class="fw-bold">"{{ $search }}"</span>.</div>
                    @endforelse

                    @if ($products->hasPages()) <div class="pt-1">{{ $products->onEachSide(1)->links(data: [ 'scrollTo' => '#products-search' ]) }}</div> @endif
                </section>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="border-bottom border-secondary">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23c7c7c7'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb my-3">
                                    <li class="breadcrumb-item me-2"><a href="{{ route('home') }}" class="h6 small link-success fw-semibold">Inicio</a></li>
                                    <li class="breadcrumb-item me-2"><a href="{{ route('category.show', $product['catalog_product_brand']['slug']) }}" class="h6 small link-success fw-semibold ms-2">{{ $product['catalog_product_brand']['name'] }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><span class="h6 small text-primary fw-semibold ms-2">{{ $product['name'] }}</span></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container mt-4">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="position-relative carousel" wire:ignore>
                    <span class="position-absolute top-0 end-0 p-3"><i class="fi-rs-search h5 opacity-50"></i></span>

                    <div class="border border-secondary rounded-4 mb-3 carousel-slider"> @foreach ($images as $image) <figure><img src="{{ $image }}" class="img-fluid" alt="{{ $product['name'] }}" data-fancybox="galeria" /></figure> @endforeach </div>
                    <div class="carousel-thumbnail"> @if (count($images) > 1) @foreach ($images as $image) <figure><img src="{{ $image }}" class="img-fluid" alt="{{ $product['name'] }}" /></figure> @endforeach @endif </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                @if ($available == 1)
                    <div class="badge text-success border border-2 border-success py-2">Disponible</div>
                @else
                    <div class="badge text-warning border border-2 border-warning py-2">Entrega Postergada</div>
                @endif

                <div class="row d-flex align-items-center">
                    <div class="col"><h1 class="text-dark fw-bold lh-1 my-2">{{ $product['name'] }}</h1></div>

                    <div class="col-auto" x-data="{ wishlist: @entangle('wishlist') }">
                        @if (auth()->check())
                            <button class="btn btn-link text-decoration-none" :class="{ 'text-dark': !wishlist, 'text-success': wishlist }" x-on:click="wishlist = !wishlist" wire:click="changeWishlist" wire:loading.attr="disabled" wire:target="addCart,selectedColor,selectedPresentation,selectedMeasurement,changeWishlist">
                                <i class="h1 fi" :class="{ 'fi-rr-heart': !wishlist, 'fi-sr-heart': wishlist }"></i>
                            </button>
                        @else
                            <a href="{{ Route('login') }}" class="btn btn-link text-dark text-decoration-none">
                                <i class="h1 fi fi-rr-heart"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="d-flex align-items-center mb-2">
                    <x-product.rating-star :ratingTotal="$product['rating_total']" />
                    <span class="small text-black-50 opacity-75 ms-2">({{ $reviewsTotal }} @choice('Experiencia|Experiencias', $reviewsTotal))</span>

                    <div class="vr mx-2"></div>

                    <span class="small text-black-50 opacity-75 me-1">Código:</span>
                    <span class="h6 text-dark fw-bold mb-0">{{ $product['sku'] }}</span>
                </div>

                <div class="row gx-3 align-items-center mb-2">
                    <div class="col-auto"><span class="h1 text-success fw-bold mb-0">{{ $price }}</span></div>

                    @if (count($this->parentProduct) > 0)
                        <div class="col">
                            <div class="h6 small text-success fw-semibold lh-1 mb-0">{{ $this->parentProduct['percentage_discount'] }}% off</div>
                            <div class="h6 text-black-50 opacity-50 fw-bold text-decoration-line-through mb-0">{{ $this->parentProduct['price'] }}</div>
                        </div>
                    @endif
                </div>

                <div>{!! $product['short_description'] !!}</div>

                @if (count($colors) > 0 || count($presentations) > 0 || count($measurements) > 0)
                    <div class="pb-2 mb-1">
                        @if (count($colors) > 0)
                            <div class="row gx-3 align-items-center mb-2">
                                <div class="col-auto"><div class="h6 text-muted fw-bold mb-0">Colores:</div></div>
                                <div class="col"><div class="d-flex"><x-product.color :colors="$colors" :available="$available" /></div></div>
                            </div>
                        @endif

                        @if (count($presentations) > 0)
                            <div class="row gx-3 align-items-center mb-2">
                                <div class="col-auto"><div class="h6 text-muted fw-bold mb-0">Presentación:</div></div>
                                <div class="col"><div class="d-flex"><x-product.presentation :presentations="$presentations" :available="$available" /></div></div>
                            </div>
                        @endif

                        @if (count($measurements) > 0)
                            <div class="row gx-3 align-items-center mb-2">
                                <div class="col-auto"><div class="h6 text-muted fw-bold mb-0">Talla / Medidas:</div></div>
                                <div class="col"><div class="d-flex"><x-product.measurement :measurements="$measurements" :available="$available" /></div></div>
                            </div>
                        @endif
                    </div>
                @endif

                <form class="mb-3" wire:submit="addCart">
                    <div class="row gx-2 align-items-center">
                        <div class="col-auto">
                            <div class="border @if ($available == 0) border-warning @else border-success @endif border-2 rounded-2 py-1 quantity">
                                <div class="row gx-0 align-items-center" x-data="{ quantity: @entangle('quantity') }">
                                    <div class="col"><input type="number" class="form-control text-muted fw-bold text-center border-0 shadow-none px-0 ms-3 py-2" x-bind:value="quantity" wire:model="quantity" readonly></div>

                                    <div class="col-auto d-flex flex-column">
                                        <button type="button" class="btn btn-link @if ($available == 0) link-warning @else link-success @endif text-decoration-none lh-1 py-0 px-1" @click="quantity++" x-bind:disabled="quantity >= 99" wire:loading.attr="disabled"><i class="fi-rs-angle-small-up @if ($available == 0) text-warning @else text-success @endif"></i></button>
                                        <button type="button" class="btn btn-link @if ($available == 0) link-warning @else link-success @endif text-decoration-none lh-1 py-0 px-1" @click="quantity--" x-bind:disabled="quantity <= 1" wire:loading.attr="disabled"><i class="fi-rs-angle-small-down @if ($available == 0) text-warning @else text-success @endif"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto"><button type="submit" class="btn h6 text-white fw-bold mb-0 @if ($available == 0) btn-warning-custom-1 @else btn-success-custom-1 @endif" wire:loading.attr="disabled" wire:target="addCart,selectedColor,selectedPresentation,selectedMeasurement,changeWishlist"><i class="fi fi-br-shopping-cart me-2"></i> Agregar al Carrito</button></div>
                        <div class="col-auto"><button type="button" class="btn btn-link text-decoration-none animation-hover-up" data-bs-toggle="tooltip" data-bs-title="Compartir"><i class="fi fi-br-share-square h3 @if ($available == 0) text-warning @else text-success @endif mb-0"></i></button></div>
                    </div>
                </form>

                @if ($available == 0)
                    @if (count($componentsNotAvailable) > 0)
                        <div class="row gx-3 mb-2 components">
                            @if (count($componentsNotAvailable) > 0)
                                <div class="col-12 col-sm-6 col-lg-12 col-xl-6">
                                    <div class="card border-warning rounded-4 overflow-hidden mb-2">
                                        <div class="card-header text-white lh-sm bg-warning border-0 px-3">
                                            <span class="fw-bold d-block py-1">Componentes con <span class="text-decoration-underline">Entrega Postergada</span></span>
                                        </div>

                                        <div class="card-body text-warning">
                                            <ul class="fa-ul ps-0 ms-4">
                                                @foreach ($componentsNotAvailable as $componentNotAvailable)
                                                    <li class="mb-2">
                                                        <span class="fa-li"><i class="fa-solid fa-angle-right fa-xs"></i></span>
                                                        {{ $componentNotAvailable['sku'] }} - <span class="fw-bold">{{ $componentNotAvailable['name'] }}</span>.
                                                        <span class="small lh-sm d-block">Fecha estimada de disponibilidad:</span>
                                                        <span class="d-block"><i class="fi fi-sr-calendar-clock position-relative me-1"></i> <span class="fs-6 fw-bold text-decoration-underline">{{ $componentNotAvailable['date'] }}</span>.</span>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <p class="small lh-sm mb-0"><span class="fw-bold">Importante:</span> Las fechas anteriormente descritas pueden cambiar.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count($componentsAvailable) > 0)
                                <div class="col-12 col-sm-6 col-lg-12 col-xl-6">
                                    <div class="card border-success rounded-4 overflow-hidden mb-2">
                                        <div class="card-header text-white lh-sm bg-success border-0 px-3">
                                            <span class="fw-bold d-block py-1">Componentes <span class="text-decoration-underline">Disponibles</span></span>
                                        </div>

                                        <div class="card-body text-success">
                                            <ul class="fa-ul ps-0 ms-4 mb-0">
                                                @foreach ($componentsAvailable as $componentAvailable)
                                                    <li class="lh-sm @if (!$loop->last) mb-2 @endif">
                                                        <span class="fa-li"><i class="fa-solid fa-angle-right fa-xs"></i></span>
                                                        {{ $componentAvailable['sku'] }} - {{ $componentAvailable['name'] }}.
                                                        <span class="d-block fw-bold">Disponible.</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="row gx-3 mb-2 components">
                            <div class="col-12 col-sm-6 col-lg-12 col-xl-6">
                                <div class="card border-warning rounded-4 overflow-hidden mb-2">
                                    <div class="card-header text-white lh-sm bg-warning border-0 px-3">
                                        <span class="fw-bold d-block py-1">Producto en <span class="text-decoration-underline">Entrega Postergada</span></span>
                                    </div>

                                    <div class="card-body text-warning">
                                        <div class="small lh-1 d-block">Fecha estimada de disponibilidad:</div>
                                        <div><i class="fi fi-sr-calendar-clock position-relative me-1"></i> <span class="fs-6 fw-bold text-decoration-underline">{{ $available_until }}</span>.</div>
                                        <p class="small lh-sm mt-2 mb-0"><span class="fw-bold">Importante:</span> La fecha anteriormente descrita pueden cambiar.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                @if ($product['warranty'] != null || $product['video'] != null)
                    <div class="mb-2">
                        @if ($product['warranty'] != null) <p class="text-success fw-bold mb-0"><i class="fi fi-br-icon-star h5 position-relative me-1 custom i-top-1"></i> {{ $product['warranty'] }}.</p>@endif
                        @if ($product['video'] != null) <p class="d-flex align-items-center mb-0"><i class="fi fi-brands-youtube h4 text-danger position-relative me-2 mb-0 custom i-top-1"></i><a href="{{ $product['video'] }}" class="link-danger fw-bold" data-fancybox="videos">Conoce el producto aquí.</a></p>@endif
                    </div>
                @endif

                @if ($differentiators != null)
                    <h2 class="h6 fw-bold mb-2 pt-2">Diferenciadores del producto:</h2>

                    <ul class="mb-4">
                        @foreach ($differentiators as $differentiator)
                        <li>{{ $differentiator }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>

    @script
        <script type="module">
            $('.product .carousel-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: false,
                asNavFor: '.product .carousel-thumbnail',
            });

            $('.product .carousel-thumbnail').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.product .carousel-slider',
                dots: false,
                focusOnSelect: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fi-rs-arrow-small-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fi-rs-arrow-small-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        },
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            Fancybox.bind('.product [data-fancybox="galeria"]', { Thumbs: false });
            Fancybox.bind('.product [data-fancybox="videos"]', { Thumbs: false });

            $wire.on('refreshImages', (data) => {
                $('.product .carousel-slider').slick('slickRemove', null, null, true);
                $('.product .carousel-thumbnail').slick('slickRemove', null, null, true);

                for (let i = 0; i < data.images.length; i++) {
                    $('.product .carousel-slider').slick('slickAdd','<figure><img src="' + data.images[i] + '" class="img-fluid" data-fancybox="galeria" /></figure>');
                    $('.product .carousel-thumbnail').slick('slickAdd','<figure><img src="' + data.images[i] + '" class="img-fluid" /></figure>');
                }
            });
        </script>
    @endscript
</div>

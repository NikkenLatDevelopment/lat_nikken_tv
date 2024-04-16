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
                                    <li class="breadcrumb-item active" aria-current="page"><span class="h6 small fw-semibold text-primary ms-2">{{ $product['name'] }}</span></li>
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
        </script>
    @endscript
</div>

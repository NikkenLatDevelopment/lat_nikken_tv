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
            </div>

            <div class="col-12 col-lg-6">
            </div>
        </div>
    </section>
</div>

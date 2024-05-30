<div class="header">
    <div class="bg-success border-top border-success border-4 py-1" style="--bs-bg-opacity: .1;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <div class="d-none d-sm-flex">
                        <a href="https://www.tiktok.com/@nikkenlatinoamerica?lang=es" target="_blank" class="link-success text-decoration-none me-2 pe-1"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.facebook.com/NIKKENLAT" target="_blank" class="link-success text-decoration-none me-2 pe-1"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/user/nikkenlatinoamerica" target="_blank" class="link-success text-decoration-none me-2 pe-1"><i class="fa-brands fa-youtube fa-lg"></i></a>
                        <a href="https://www.instagram.com/nikkenlatam/" target="_blank" class="link-success text-decoration-none"><i class="fa-brands fa-instagram fa-lg"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-auto">
                    <div class="hstack gap-3 justify-content-end">
                        @if (!auth()->check())
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('contact.show') }}" class="small link-success d-none d-lg-inline-block">Contáctanos</a>
                                <a href="{{ route('auth.create') }}" class="small link-success d-lg-none">Registrarme</a>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('auth.create') }}" class="small link-success fw-bold d-none d-lg-inline-block">Registrarme</a>
                                <a href="{{ route('login') }}" class="small link-success fw-bold d-lg-none">Iniciar Sesión</a>
                            </div>
                        @else
                            <a href="{{ route('contact.show') }}" class="small link-success d-none d-lg-flex">Contáctanos</a>

                            <div class="position-relative d-lg-none profile">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-link dropdown-toggle link-success text-decoration-none lh-1 d-flex align-items-center p-0" data-bs-toggle="dropdown" aria-expanded="false"><span class="text-truncate name">{{ auth()->user()->name }}</span></button>
                                    <x-general.header.user.profile-options />
                                </div>
                            </div>
                        @endif

                        <div class="vr my-auto"></div>
                        @livewire('general.header.content.main.catalog-countries')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border-bottom border-secondary">
        <div class="container my-3 pb-2 pb-lg-1">
            <div class="row gx-3 align-items-top align-items-lg-center justify-content-between">
                <div class="col-auto order-1">
                    <div class="d-flex align-items-center">
                        <div class="d-flex d-lg-none align-items-center mt-2 me-3">
                            <button type="button" class="btn btn-sm btn-link h6 link-dark fw-bold text-decoration-none lh-1 p-0 mb-0 me-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenuResponsive" aria-controls="offcanvasMenuResponsive"><i class="fa-solid fa-bars fa-xl me-1"></i> Menú</button>
                            <div class="vr my-auto"></div>
                        </div>

                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <img src="{{ asset('assets/img/general/logo.png') }}" srcset="{{ asset('assets/img/general/logo-2x.png') }} 2x" class="img-fluid" alt="Mi Tienda NIKKEN">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg order-3 order-lg-2">
                    @livewire('general.header.content.main.search')
                </div>

                <div class="col-auto order-2 order-lg-3">
                    <div class="hstack gap-3 mt-1 pe-2 pe-lg-0 me-2">
                        <button type="button" class="btn btn-sm btn-link p-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWishlist" aria-controls="offcanvasWishlist">
                            <span class="position-relative">
                                <img src="{{ asset('assets/img/general/icon-wishlist.png') }}" srcset="{{ asset('assets/img/general/icon-wishlist-2x.png') }} 2x" class="img-fluid" alt="Lista de Deseos">
                                @livewire('general.header.content.wishlist.count')
                            </span>
                        </button>

                        <button type="button" class="btn btn-sm btn-link p-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <span class="position-relative">
                                <img src="{{ asset('assets/img/general/icon-cart.png') }}" srcset="{{ asset('assets/img/general/icon-cart-2x.png') }} 2x" class="img-fluid" alt="Carrito de Compras">
                                @livewire('general.header.content.cart.count')
                            </span>
                        </button>

                        <div class="d-none d-lg-flex">
                            <div class="vr my-auto me-3"></div>

                            <div class="lh-1 profile">
                                @if (auth()->check())
                                    <div class="small"><i class="fi fi-rr-hand-wave"></i> ¡Hola!</div>

                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle link-dark fw-bold text-decoration-none lh-1 d-flex align-items-center p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="text-truncate name">{{ auth()->user()->name }}</span></button>
                                        <x-general.header.user.profile-options />
                                    </div>
                                @else
                                    <div class="small">¡Bienvenido(a)!</div>
                                    <a href="{{ route('login') }}" class="h6 text-dark fw-bold mb-0">Iniciar Sesión</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">@livewire('general.header.content.main.menu')</div>
    <x-general.header.wishlist />
    <x-general.header.cart />
</div>

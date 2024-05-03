<div>
    <div class="bg-white border-bottom border-secondary d-none d-lg-block w-100 py-1 menu sticky">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav>
                        <ul class="p-0 m-0">
                            <li class="py-3 me-4"><a href="{{ route('home') }}" class="h6 link-dark fw-bold text-decoration-none"><i class="fi fi-br-house-blank position-relative me-2"></i>Inicio</a></li>

                            @if (!empty($catalogProductBrands))
                                <li class="py-3 me-4">
                                    <a href="#" class="h6 link-dark fw-bold text-decoration-none">Productos <i class="fi fi-rr-angle-small-down position-relative"></i></a>

                                    <ul class="list-unstyled bg-white border border-secondary rounded-3 position-absolute start-0 mt-2 sub-menu">
                                        @foreach ($catalogProductBrands as $index => $catalogProductBrand)
                                            <li wire:key="general-header-content-main-menu-catalog-product-brand-{{ $index }}"><a href="{{ route('category.show', $catalogProductBrand['slug']) }}" class="h6 link-primary fw-bold text-decoration-none lh-1 d-block mb-0">{{ $catalogProductBrand['alias'] }} <span class="small text-black-50 opacity-75 fw-semibold d-block subtitle">{{ $catalogProductBrand['name'] }}</span></a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                            @if (!empty($campaigns))
                                @if (!empty($campaigns))
                                    <li class="py-3 me-4">
                                        <a href="#" class="h6 link-success fw-bold text-decoration-none"><i class="fa-solid fa-bell me-1 custom bell-1"></i> Campañas <i class="fi fi-rr-angle-small-down position-relative"></i></a>

                                        <ul class="list-unstyled bg-white border border-secondary border-1 rounded-3 position-absolute start-0 mt-2 sub-menu">
                                            @foreach ($campaigns as $index => $campaign)
                                                <li wire:key="general-header-content-main-menu-campaign-{{ $index }}"><a href="{{ $campaign['url'] }}" class="h6 link-primary fw-bold text-decoration-none lh-1 d-block mb-0">{{ $campaign['name'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    @foreach ($campaigns as $index => $campaign)
                                        <li class="py-3 me-4" wire:key="general-header-content-main-menu-campaign-{{ $index }}"><a href="{{ $campaign['url'] }}" class="h6 link-success fw-bold text-decoration-none"><i class="fa-solid fa-bell me-1 custom bell-1"></i> {{ $campaign['name'] }}</a></li>
                                    @endforeach
                                @endif
                            @endif

                            <li class="py-3 me-4"><a href="{{ route('replacement.index') }}" class="h6 link-dark fw-bold text-decoration-none">Repuestos y Piezas</a></li>
                            <li class="py-3 me-4"><a href="{{ route('event.index') }}" class="h6 link-dark fw-bold text-decoration-none">Eventos</a></li>
                            <li class="py-3"><a href="{{ route('tool.index') }}" class="h6 link-dark fw-bold text-decoration-none">Material de Apoyo</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start border-0" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header pb-2">
            <a href="{{ route('home') }}" class="text-decoration-none ms-3">
                <img src="{{ asset('assets/img/general/logo.png') }}" srcset="{{ asset('assets/img/general/logo-2x.png') }} 2x" class="img-fluid" alt="Mi Tienda NIKKEN">
            </a>

            <div class="pe-3 me-1">
                <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
            </div>
        </div>

        <div class="offcanvas-body">
            <div class="menu-responsive mb-4">
                <div class="accordion accordion-generalHeaderContentMainMenuResponsiveAccordion" id="geCampaignalHeaderContentMainMenuResponsiveAccordion">
                    <div class="accordion-item not-sub-menu">
                        <div class="h6 accordion-header">
                            <a href="{{ route('home') }}" class="accordion-button collapsed link-dark fw-bold text-decoration-none shadow-none">Inicio</a>
                        </div>
                    </div>

                    @if (!empty($catalogProductBrands))
                        <div class="accordion-item">
                            <div class="h6 accordion-header" id="generalHeaderContentMainMenuResponsiveAccordion-headingBrand">
                                <a href="#generalHeaderContentMainMenuResponsiveAccordion-collapseBrand" class="accordion-button collapsed link-dark fw-bold text-decoration-none bg-white shadow-none"  data-bs-toggle="collapse" aria-expanded="false" aria-controls="generalHeaderContentMainMenuResponsiveAccordion-collapseBrand">Productos</a>
                            </div>

                            <div id="generalHeaderContentMainMenuResponsiveAccordion-collapseBrand" class="accordion-collapse collapse" aria-labelledby="generalHeaderContentMainMenuResponsiveAccordion-headingBrand" data-bs-parent="#generalHeaderContentMainMenuResponsiveAccordion">
                                <div class="accordion-body pt-0 ms-3">
                                    <ul class="list-unstyled my-0 sub-menu">
                                        @foreach ($catalogProductBrands as $index => $catalogProductBrand)
                                            <li class="py-2" wire:key="general-header-content-main-menu-catalog-product-brand-{{ $index }}"><a href="{{ route('category.show', $catalogProductBrand['slug']) }}" class="h6 fw-bold text-decoration-none lh-1 d-block mb-0">{{ $catalogProductBrand['alias'] }} <span class="small text-black-50 opacity-75 fw-semibold d-block subtitle">{{ $catalogProductBrand['name'] }}</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (!empty($campaigns))
                        @if (!empty($campaigns))
                            <div class="accordion-item">
                                <div class="h6 accordion-header" id="generalHeaderContentMainMenuResponsiveAccordion-headingCampaign">
                                    <a href="#generalHeaderContentMainMenuResponsiveAccordion-collapseCampaign" class="accordion-button collapsed link-success fw-bold text-decoration-none lh-1 bg-white shadow-none"  data-bs-toggle="collapse" aria-expanded="false" aria-controls="generalHeaderContentMainMenuResponsiveAccordion-collapseCampaign"><i class="fa-solid fa-bell me-2 custom bell-1"></i> Campañas</a>
                                </div>

                                <div id="generalHeaderContentMainMenuResponsiveAccordion-collapseCampaign" class="accordion-collapse collapse" aria-labelledby="generalHeaderContentMainMenuResponsiveAccordion-headingCampaign" data-bs-parent="#generalHeaderContentMainMenuResponsiveAccordion">
                                    <div class="accordion-body pt-0 ms-3">
                                        <ul class="list-unstyled my-0 sub-menu">
                                            @foreach ($campaigns as $index => $campaign)
                                                <li class="py-2" wire:key="general-header-content-main-menu-campaign-{{ $index }}"><a href="{{ $campaign['url'] }}" class="h6 fw-bold text-decoration-none lh-1 d-block mb-0">{{ $campaign['name'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($campaigns as $index => $campaign)
                                <div class="accordion-item not-sub-menu" wire:key="general-header-content-main-menu-campaign-{{ $index }}">
                                    <div class="h6 accordion-header">
                                        <a href="{{ $campaign['url'] }}" class="accordion-button collapsed link-success fw-bold text-decoration-none lh-1 shadow-none"><i class="fa-solid fa-bell me-2 custom bell-1"></i> {{ $campaign['name'] }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif

                    <div class="accordion-item not-sub-menu">
                        <div class="h6 accordion-header">
                            <a href="{{ route('replacement.index') }}" class="accordion-button collapsed link-dark fw-bold text-decoration-none shadow-none">Repuestos y Piezas</a>
                        </div>
                    </div>

                    <div class="accordion-item not-sub-menu">
                        <div class="h6 accordion-header">
                            <a href="{{ route('event.index') }}" class="accordion-button collapsed link-dark fw-bold text-decoration-none shadow-none">Eventos</a>
                        </div>
                    </div>

                    <div class="accordion-item not-sub-menu">
                        <div class="h6 accordion-header">
                            <a href="{{ route('tool.index') }}" class="accordion-button collapsed link-dark fw-bold text-decoration-none shadow-none">Material de Apoyo</a>
                        </div>
                    </div>

                    <div class="accordion-item not-sub-menu">
                        <div class="h6 accordion-header">
                            <a href="{{ route('contact.show') }}" class="accordion-button collapsed link-dark fw-bold text-decoration-none shadow-none">Contáctanos</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ms-4">
                <div class="d-flex">
                    <a href="https://www.tiktok.com/@nikkenlatinoamerica?lang=es" target="_blank" class="link-success text-decoration-none me-2 pe-1"><i class="fa-brands fa-tiktok fa-lg"></i></a>
                    <a href="https://www.facebook.com/NIKKENLAT" target="_blank" class="link-success text-decoration-none me-2 pe-1"><i class="fa-brands fa-facebook-f fa-lg"></i></a>
                    <a href="https://www.youtube.com/user/nikkenlatinoamerica" target="_blank" class="link-success text-decoration-none me-2 pe-1"><i class="fa-brands fa-youtube fa-xl"></i></a>
                    <a href="https://www.instagram.com/nikkenlatam/" target="_blank" class="link-success text-decoration-none"><i class="fa-brands fa-instagram fa-xl"></i></a>
                </div>

                <hr>
                <p class="small text-black-50 opacity-50 lh-sm mt-2">&copy; Todos los derechos reservados - Desarrollado por NIKKEN Latinoamérica.</p>
            </div>
        </div>
    </div>
</div>

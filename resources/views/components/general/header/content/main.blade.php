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
                        @if (!Auth::check())
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
                            <div class="profile position-relative d-lg-none"><x-general.header.profile.options /></div>
                        @endif

                        <div class="vr my-auto"></div>
                        @livewire('general.header.content.main.catalog-countries')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

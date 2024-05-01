<h2 class="h2 text-dark fw-bold lh-1 mb-0">Dirección de Envío</h2>
<p class="mb-4">Aquí recibirás @choice('tu producto|tus <span class="text-success fw-bold">'  . $this->cartForm->quantity .' productos</span>', $this->cartForm->quantity)  NIKKEN.</p>

<ul class="nav nav-pills my-3" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up active" id="checkout-address-new-tab" data-bs-toggle="pill" data-bs-target="#checkout-address-new" type="button" role="tab" aria-controls="checkout-address-new" aria-selected="true">
            <i class="fi fi-sr-map-pin position-relative custom i-top-2 me-1"></i>Nueva Dirección
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="btn h5 fw-bold border border-secondary rounded-4 px-3 py-2 me-2 btn-outline-primary-custom-1 animation-hover-up" id="checkout-address-exists-tab" data-bs-toggle="pill" data-bs-target="#checkout-address-exists" type="button" role="tab" aria-controls="checkout-address-exists" aria-selected="false">
            <i class="fi fi-br-search position-relative custom i-top-2 me-2"></i>Direcciones Existentes
        </button>
    </li>
</ul>

<div class="tab-content border-top border-secondary pt-4">
    <div class="tab-pane fade show active" id="checkout-address-new" role="tabpanel" aria-labelledby="checkout-address-new-tab" tabindex="0">
        <x-checkout.address-country />
    </div>

    <div class="tab-pane fade" id="checkout-address-exists" role="tabpanel" aria-labelledby="checkout-address-exists-tab" tabindex="0"></div>
</div>

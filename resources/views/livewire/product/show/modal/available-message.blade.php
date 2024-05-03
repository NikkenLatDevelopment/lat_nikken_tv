<div>
    <div class="modal fade" id="productShowModalAvailableMessage" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border border-warning border-4 rounded-4 overflow-hidden">
                <div class="modal-body">
                    @if (!empty($componentNotAvailablesProduct))
                        <p class="text-center lh-sm mt-2">Recuerda que los productos a continuación <span class="fs-5 text-warning text-decoration-underline lh-1 custom fw-extrabold">no se encuentran disponibles:</span></p>

                        <ul class="fa-ul ps-0 ms-4 components">
                            @foreach ($componentNotAvailablesProduct as $componentNotAvailableProduct)
                                <li class="mb-3" wire:key="product-show-modal-available-message-component-not-available-{{ $index }}">
                                    <span class="fa-li"><i class="fa-solid fa-angle-right fa-xs"></i></span>
                                    <span class="lh-sm d-block mb-2">{{ $componentNotAvailableProduct['sku'] }} - <span class="fw-bold">{{ $componentNotAvailableProduct['name'] }}</span>.</span>
                                    <span class="small lh-sm d-block">Fecha estimada de disponibilidad:</span>
                                    <span class="lh-sm d-block"><i class="fi fi-sr-calendar-clock position-relative me-1"></i> <span class="fs-6 fw-bold text-decoration-underline">{{ $componentNotAvailableProduct['date'] }}</span>.</span>
                                </li>
                            @endforeach
                        </ul>

                        <p class="small lh-sm mb-2"><span class="fw-bold">Importante:</span> Las fechas anteriormente descritas pueden cambiar.</p>
                    @else
                        <p class="text-center lh-sm mt-2">Recuerda que este producto <span class="fs-5 text-warning text-decoration-underline lh-1 custom fw-extrabold">no se encuentran disponible:</span></p>

                        <ul class="fa-ul ps-0 ms-4 components">
                            <li class="mb-3">
                                <span class="fa-li"><i class="fa-solid fa-angle-right fa-xs"></i></span>
                                <span class="lh-sm d-block mb-2">{{ $skuProduct }} - <span class="fw-bold">{{ $nameProduct }}</span>.</span>
                                <span class="small lh-sm d-block">Fecha estimada de disponibilidad:</span>
                                <span class="lh-sm d-block"><i class="fi fi-sr-calendar-clock position-relative me-1"></i> <span class="fs-6 fw-bold text-decoration-underline">{{ $availableUntilProduct }}</span>.</span>
                            </li>
                        </ul>

                        <p class="small lh-sm mb-2"><span class="fw-bold">Importante:</span> Las fecha anteriormente descrita pueden cambiar.</p>
                    @endif

                    <div class="text-center pt-2">
                        <button type="button" class="btn h6 text-white fw-bold mb-0 btn-warning-custom-1" wire:click="addCart" wire:loading.attr="disabled"><i class="fi fi-br-shopping-cart me-2"></i> Agregar al Carrito</button>
                        <button class="btn btn-sm btn-link h6 link-primary fw-semibold text-decoration-none mt-2 mb-0" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @script
        <script type="module">
            let modalInstance = new bootstrap.Modal(document.getElementById('productShowModalAvailableMessage'));

            $wire.on('productShowModalAvailableMessage', (data) => {
                if (data.view == 'show') { modalInstance.show();
                } else if (data.view == 'hide') { modalInstance.hide(); }
            });
        </script>
    @endscript
</div>

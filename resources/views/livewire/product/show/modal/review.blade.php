<div>
    <div class="modal fade" id="productShowModalReview" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border border-dark border-4 rounded-4 overflow-hidden">
                <div class="modal-body p-4">
                    <div class="position-absolute top-0 end-0 p-2"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>

                    <form wire:submit="create">
                        <div class="h6 text-muted">Experiencia del producto <span class="h5 text-dark fw-bold">{{ $productName }}</span></div>
                        <div class="h6 text-warning fw-semibold lh-sm pt-1 mb-1">Calificación:</div>

                        <div class="mb-2" x-data="{ rating: $wire.entangle('rating') }">
                            <template x-for="star in 5"><i class="fi fi-sr-star h5 text-secondary me-1 mb-0 custom cursor-pointer" :class="{ 'text-warning': rating >= star }" @click="rating = star"></i></template>
                            @error('rating') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                        </div>

                        <ul class="fa-ul mb-3 ms-4 py-1">
                            <li class="small text-black-50 opacity-75 lh-sm"><span class="fa-li"><i class="fa-solid fa-circle-info"></i></span>Recuerda ser respetuoso(a) en tu experiencia. Valoramos tu opinión y queremos que nuestra comunidad sea un espacio seguro para todo(a)s.</li>
                        </ul>

                        <div class="form-floating mb-2">
                            <textarea class="form-control text-dark rounded-4 @error('comment') is-invalid @enderror" placeholder="Experiencia *" id="product-show-modal-review-comment" wire:model="comment" style="height: 200px"></textarea>
                            <label for="product-show-modal-review-comment">Experiencia *</label>

                            @error('comment') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                        </div>

                        <button type="submit" class="btn h6 text-white fw-bold w-100 mb-0 btn-dark-custom-1">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @script
        <script type="module">
            let modalInstance = new bootstrap.Modal(document.getElementById('productShowModalReview'));

            $wire.on('productShowModalReview', (data) => {
                if (data.view == 'show') { modalInstance.show();
                } else if (data.view == 'hide') { modalInstance.hide(); }
            });
        </script>
    @endscript
</div>

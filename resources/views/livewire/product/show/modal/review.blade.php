<div>
    <div class="modal fade" id="productShowModalReview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border border-dark border-4 rounded-4 overflow-hidden">
                <div class="modal-body p-4">
                    <div class="position-absolute top-0 end-0 p-2"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>

                    <form id="form-review">
                        <div class="h6 text-muted">Experiencia del producto <span class="h5 text-dark fw-bold">{{ $productName }}</span></div>
                        <div class="lh-sm pt-1 mb-1">Calificación:</div>

                        <div class="mb-2" x-data="{ rating: @entangle('rating') }">
                            <template x-for="star in 5">
                                <i class="fi fi-sr-star h5 text-secondary me-1 mb-0 custom cursor-pointer" :class="{ 'text-warning': rating >= star }" @click="rating = star"></i>
                            </template>
                        </div>

                        <ul class="fa-ul mb-3 ms-4 pb-1 pt-1">
                            <li class="small text-black-50 opacity-75 lh-sm"><span class="fa-li"><i class="fa-solid fa-circle-info"></i></span>Recuerda ser respetuoso(a) en tu experiencia. Valoramos tu opinión y queremos que nuestra comunidad sea un espacio seguro para todo(a)s.</li>
                        </ul>

                        <div class="form-floating mb-2">
                            <textarea class="form-control text-dark bg-light border-secondary" placeholder="Experiencia: (*)" id="form-review-comment" style="height: 200px"></textarea>
                            <label for="form-review-comment">Experiencia: (*)</label>
                        </div>

                        <button class="btn h6 text-white fw-bold mb-0 w-100 btn-dark-custom-1">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @script
        <script type="module">
            $wire.on('productShowModalReview', () => {
                new bootstrap.Modal(document.getElementById('productShowModalReview')).show();
            });
        </script>
    @endscript
</div>

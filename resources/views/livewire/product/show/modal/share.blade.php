<div>
    <div class="modal fade" id="productShowModalShare" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-success border-4 rounded-4 overflow-hidden">
                <div class="modal-body p-4">
                    <div class="position-absolute top-0 end-0 p-2"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>

                    <div class="h5 text-dark fw-bold mb-0"><i class="fi fi-br-share-square position-relative mb-0 custom i-top-4"></i> Compartir</div>
                    <p class="lh-sm">Comparte este link con tus amigo(a)s y conocido(a)s.</p>

                    <div class="input-group border border-1 border-secondary rounded-3 overflow-hidden mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control text-dark fw-bold text-decoration-underline bg-light border-end-0 border-light shadow-none" id="product-share-url" placeholder="Link" value="{{ $currentUrl }}">
                            <label for="product-share-url">Link</label>
                        </div>

                        <button type="button" class="btn btn-sm input-group-text link-success fw-semibold bg-light border-light pe-3" id="product-share-btn"><i class="fi fi-rr-copy-alt fs-5 position-relative mb-0 me-1 custom i-top-3"></i> Copiar</button>
                    </div>

                    @if (!auth()->check())
                        <p class="small"><span class="fw-bold">Nota:</span> Si cuentas con tu Tienda Virtual Personalizada, <a href="{{ route('login') }}">inicia sesión</a> para obtener tu link personal.</p>
                    @endif

                    @if($currentUrl && $name)
                        <hr class="text-secondary opacity-75">
                        <div class="h6 text-dark fw-bold mb-0 mt-4">Compartir en redes sociales:</div>

                        <div>
                            <div class="d-inline-block pe-1"><a href="https://api.whatsapp.com/send?text={{ $name }}%20{{ $currentUrl }}" target="_blank" class="h6 small link-primary fw-semibold me-2">WhatsApp</a></div>
                            <div class="d-inline-block pe-1"><a href="https://telegram.me/share/url?url={{ $currentUrl }}&text={{ $name }}" target="_blank" class="h6 small link-primary fw-semibold me-2">Telegram</a></div>
                            <div class="d-inline-block pe-1"><a href="http://www.facebook.com/sharer.php?u={{ $currentUrl }}/&t={{ $name }}" target="_blank" class="h6 small link-primary fw-semibold me-2">Facebook</a></div>
                            <div class="d-inline-block pe-1"><a href="https://twitter.com/intent/tweet?text={{ $name }}&url={{ $currentUrl }}" target="_blank" class="h6 small link-primary fw-semibold me-2">X (Antes Twitter)</a></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @script
        <script type="module">
            $wire.on('productShowModalShare', () => {
                new bootstrap.Modal(document.getElementById('productShowModalShare')).show();
            });
        </script>

        @push('scripts')
            <script>
                document.getElementById("product-share-btn").addEventListener("click", function () {
                    let copyText = document.getElementById("product-share-url");
                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    document.execCommand("copy");

                    showToast('<span class="fw-bold text-decoration-underline">Link copiado</span> en tu portapapeles.', 'success');
                });

                document.getElementById("product-share-url").addEventListener("click", function () {
                    this.focus();
                    this.select();
                });
            </script>
        @endpush
    @endscript
</div>

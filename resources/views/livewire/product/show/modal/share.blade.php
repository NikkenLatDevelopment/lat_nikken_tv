<div>
    <div class="modal fade" id="productShowModalShare" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-success border-4 rounded-4 overflow-hidden">
                <div class="modal-body">
                    <div class="position-absolute top-0 end-0 p-2"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
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
    @endscript
</div>

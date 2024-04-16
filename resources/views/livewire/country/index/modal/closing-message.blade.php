<div>
    <div class="modal fade" id="countryIndexModalClosingMessage" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-4 border-secondary rounded-4 overflow-hidden">
                <div class="modal-body p-4">
                    <div class="position-absolute top-0 end-0 p-2"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
                    {!! $message !!}
                </div>
            </div>
        </div>
    </div>

    @script
        <script type="module">
            $wire.on('countryIndexModalClosingMessage', () => {
                new bootstrap.Modal(document.getElementById('countryIndexModalClosingMessage')).show();
            });
        </script>
    @endscript
</div>

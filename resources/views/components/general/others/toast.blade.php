<div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast text-white bg-success border-0 align-items-center" role="alert" aria-live="assertive" aria-atomic="true" id="liveToast">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script type="module">
    document.addEventListener('livewire:init', () => {
        Livewire.on('showToast', (data) => {
            showToast(data.message, data.color);
        });
    });
</script>

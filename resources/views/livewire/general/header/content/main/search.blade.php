<div>
    <form class="mt-1 mt-lg-0 search" wire:submit="search">
        <div class="input-group bg-secondary border border-2 border-white rounded-3 shadow-sm">
            <div class="form-floating">
                <input type="text" class="form-control bg-transparent border-0 shadow-none" id="general-header-content-search" wire:model="query" placeholder="Buscar..." autocomplete="off">
                <label for="general-header-content-search" class="text-muted">Buscar...</label>
            </div>

            <button type="submit" class="btn btn-link text-decoration-none border-start border-top-0 border-bottom-0 border-end-0 border-2 border-white rounded-0 my-2 py-0 px-3"><i class="fi fi-rr-search h5 position-relative"></i></button>
        </div>
    </form>
</div>

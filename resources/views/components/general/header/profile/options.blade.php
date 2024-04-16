<div class="dropdown">
    <button class="btn btn-sm btn-link dropdown-toggle link-success fw-bold text-decoration-none lh-1 d-flex align-items-center p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="text-truncate name">{{ Auth::user()->name }}</span></button>

    <ul class="dropdown-menu overflow-hidden animate__animated animate__fadeIn animate__faster">
        <li><h6 class="dropdown-header fw-bold opacity-75">Opciones</h6></li>
        <li><a href="#" class="dropdown-item d-flex align-items-center"><i class="fi fi-rr-angle-small-right me-1"></i> Mi Cuenta</a></li>
        <li><a href="#" class="dropdown-item d-flex align-items-center"><i class="fi fi-rr-angle-small-right me-1"></i> Seguimiento de Pedido</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a href="#" class="dropdown-item d-flex align-items-center" wire:click.prevent="logout"><i class="fi fi-rr-angle-small-right me-1"></i> Cerrar Sesión</a></li>
    </ul>
</div>

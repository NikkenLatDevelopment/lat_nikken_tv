<div>
    <form wire:submit="login">
        <div class="form-floating mb-2">
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="auth-index-content-signin-email" wire:model="email" placeholder="Correo Electrónico / Código (*)">
            <label for="auth-index-content-signin-email">Correo Electrónico / Código (*)</label>

            @error('email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
        </div>

        <div class="form-floating position-relative mb-2" x-data="{ passwordVisible: false }">
            <input :type="passwordVisible ? 'text' : 'password'" class="form-control @error('password') is-invalid @enderror" id="auth-index-content-signin-password" wire:model="password" placeholder="Contraseña (*)">
            <label for="auth-index-content-signin-password">Contraseña (*)</label>

            <button type="button" class="btn btn-link text-decoration-none bg-white position-absolute end-0 me-1 view-password" @click="passwordVisible = !passwordVisible">
                <i :class="passwordVisible ? 'fi fi-ss-eye-crossed' : 'fi fi-sr-eye'" class="h5 mb-0 mt-1"></i>
            </button>

            @error('password') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
        </div>

        <div class="form-check form-switch mb-4">
            <input type="checkbox" class="form-check-input position-relative" role="switch" id="auth-index-content-signin-remember" wire:model="remember">
            <label class="form-check-label" for="auth-index-content-signin-remember">Recordar mi ingreso</label>
        </div>

        <button type="submit" class="btn h6 text-white fw-bold mb-0 btn-dark-custom-1" wire:loading.attr="disabled">Ingresar <span class="spinner-border spinner-border-sm ms-1" wire:loading wire:target="login" role="status"><span class="visually-hidden">Loading...</span></span></button>
    </form>
</div>

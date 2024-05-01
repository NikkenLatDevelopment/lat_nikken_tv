<div class="fw-bold">Selecciona una dirección para continuar.</div>
<div class="small mb-3">Si deseas actualizar la información de alguna de las direcciones, debes dirigirte a tu cuenta, sección mis direcciones.</div>

@switch($this->country['id'])
    @case(1)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-complement" placeholder="Complemento">
                    <label for="checkout-address-country-complement">Complemento</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state" wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Ciudad *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(2)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('comment') is-invalid @enderror" x-on:input="if (!/^\d*$/.test($el.value)) $el.value = $el.value.replace(/[^0-9]/g, '')" x-on:input="if ($el.value.length > 1) $el.value = $el.value.slice(0, 1)" id="checkout-address-country-postal-code" wire:model.blur="postalCode" placeholder="Código Postal *">
                    <label for="checkout-address-country-postal-code">Código Postal *</label>

                    @error('postalCode') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model="state" wire:loading.attr="disabled" wire:target="postalCode" aria-label="Estado *">
                        @forelse ($this->addressForm->catalogStates as $catalogState)
                            <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option>
                        @empty
                            <option selected>Selecciona una opción</option>
                        @endforelse
                    </select>

                    <label for="checkout-address-country-state">Estado *</label>
                    <div wire:loading wire:target="postalCode"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo estados, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model="municipality" aria-describedby="checkoutAddressMunicipality" wire:loading.attr="disabled" wire:target="postalCode" aria-label="Municipio *">
                        @forelse ($this->addressForm->catalogMunicipalities as $catalogMunicipality)
                            <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option>
                        @empty
                            <option selected>Selecciona una opción</option>
                        @endforelse
                    </select>

                    <label for="checkout-address-country-municipality">Municipio *</label>
                    <div wire:loading wire:target="postalCode"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-colony" wire:model="colony" aria-describedby="checkoutAddressColony" wire:loading.attr="disabled" wire:target="postalCode" aria-label="Colonia *">
                        @if (empty($this->addressForm->catalogColonies) || count($this->addressForm->catalogColonies) > 1) <option selected>Selecciona una opción</option> @endif
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-colony">Colonia *</label>
                    <div wire:loading wire:target="postalCode"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo colonias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(3)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Provincia *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo provincias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-colony">Distrito *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(4)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Ciudad *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Parroquia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-colony">Parroquia *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo parroquias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(5)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Distrito *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Corregimiento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-colony">Corregimiento *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo corregimientos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(6)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Municipio *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(7)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Municipio *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(8)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Dirección *">
                    <label for="checkout-address-country-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia">
                    <label for="checkout-address-country-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Cantón *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Cantón *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo cantones, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-colony">Distrito *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(10)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-country-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-country-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-country-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-country-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-address" placeholder="Calle *">
                    <label for="checkout-address-country-address">Calle *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-complement" placeholder="Número *">
                    <label for="checkout-address-country-complement">Número *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-reference" placeholder="Referencia *">
                    <label for="checkout-address-country-reference">Referencia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-country-postal-code" placeholder="Código Postal *">
                    <label for="checkout-address-country-postal-code">Código Postal *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Región *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-state">Región *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-municipality">Ciudad *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-country-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Comuna *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-country-colony">Comuna *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo comunas, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break
    @default
@endswitch

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="checkout-address-country-save" wire:model="addressForm.saveAddress">
    <label class="form-check-label text-muted" for="checkout-address-country-save">Guardar dirección para futuras compras.</label>
</div>

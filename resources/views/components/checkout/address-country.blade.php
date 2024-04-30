@switch($this->country['id'])
    @case(1)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-complement" placeholder="Complemento">
                    <label for="checkout-address-complement">Complemento</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state" wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Ciudad *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(2)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('comment') is-invalid @enderror" x-on:input="if (!/^\d*$/.test($el.value)) $el.value = $el.value.replace(/[^0-9]/g, '')" x-on:input="if ($el.value.length > 1) $el.value = $el.value.slice(0, 1)" id="checkout-address-postal-code" wire:model.blur="postalCode" placeholder="Código Postal *">
                    <label for="checkout-address-postal-code">Código Postal *</label>

                    @error('postalCode') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model="state" wire:loading.attr="disabled" wire:target="postalCode" aria-label="Estado *">
                        @forelse ($this->addressForm->catalogStates as $catalogState)
                            <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option>
                        @empty
                            <option selected>Selecciona una opción</option>
                        @endforelse
                    </select>

                    <label for="checkout-address-state">Estado *</label>
                    <div wire:loading wire:target="postalCode"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo estados, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model="municipality" aria-describedby="checkoutAddressMunicipality" wire:loading.attr="disabled" wire:target="postalCode" aria-label="Municipio *">
                        @forelse ($this->addressForm->catalogMunicipalities as $catalogMunicipality)
                            <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option>
                        @empty
                            <option selected>Selecciona una opción</option>
                        @endforelse
                    </select>

                    <label for="checkout-address-municipality">Municipio *</label>
                    <div wire:loading wire:target="postalCode"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" wire:model="colony" aria-describedby="checkoutAddressColony" wire:loading.attr="disabled" wire:target="postalCode" aria-label="Colonia *">
                        @if (empty($this->addressForm->catalogColonies) || count($this->addressForm->catalogColonies) > 1) <option selected>Selecciona una opción</option> @endif
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-colony">Colonia *</label>
                    <div wire:loading wire:target="postalCode"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo colonias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(3)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Provincia *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo provincias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-colony">Distrito *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(4)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Ciudad *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Parroquia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-colony">Parroquia *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo parroquias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(5)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Distrito *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Corregimiento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-colony">Corregimiento *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo corregimientos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(6)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Municipio *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(7)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Municipio *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(8)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Cantón *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Cantón *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo cantones, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-colony">Distrito *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break

    @case(10)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-address" placeholder="Calle *">
                    <label for="checkout-address-address">Calle *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-complement" placeholder="Número *">
                    <label for="checkout-address-complement">Número *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-reference" placeholder="Referencia *">
                    <label for="checkout-address-reference">Referencia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="checkout-address-postal-code" placeholder="Código Postal *">
                    <label for="checkout-address-postal-code">Código Postal *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" wire:model.live="state"  wire:loading.attr="disabled" aria-label="Región *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogStates as $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-state">Región *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" wire:model.live="municipality" wire:loading.attr="disabled" wire:target="state" aria-describedby="checkoutAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogMunicipalities as $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-municipality">Ciudad *</label>
                    <div wire:loading wire:target="state"><div id="checkoutAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" wire:model="colony" wire:loading.attr="disabled" wire:target="state, municipality" aria-describedby="checkoutAddressColony" aria-label="Comuna *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->addressForm->catalogColonies as $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="checkout-address-colony">Comuna *</label>
                    <div wire:loading wire:target="municipality"><div id="checkoutAddressColony" class="form-text">Obteniendo comunas, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>
                </div>
            </div>
        </div>
        @break
    @default
@endswitch

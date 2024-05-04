@switch($this->userAddressForm->catalogCountry['id'])
    @case(1)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *">
                    <label for="forms-user-address-address">Dirección *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-complement-address" wire:model="userAddressForm.complementAddress" placeholder="Complemento" aria-describedby="formsUserAddressCountryComplement">
                    <label for="forms-user-address-complement-address">Complemento</label>

                    <div id="formsUserAddressCountryComplement" class="form-text">(Torre, Apartamento, Casa, Etc).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>

                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm" wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Departamento *</label>

                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Ciudad *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(2)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *" aria-describedby="formsUserAddressCountryAddress">
                    <label for="forms-user-address-address">Dirección *</label>

                    <div id="formsUserAddressCountryAddress" class="form-text">(Calle y Número).</div>
                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>

                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('postalCodeUserAddressForm') is-invalid @enderror @error('userAddressForm.postalCode') is-invalid @enderror" x-on:input="if (!/^\d*$/.test($el.value)) $el.value = $el.value.replace(/[^0-9]/g, '')" x-on:input="if ($el.value.length > 1) $el.value = $el.value.slice(0, 1)" id="forms-user-address-postal-code" wire:model.blur="postalCodeUserAddressForm" placeholder="Código Postal *">
                    <label for="forms-user-address-postal-code">Código Postal *</label>

                    @error('postalCodeUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.postalCode') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model="userAddressForm.state" wire:loading.attr="disabled" wire:target="postalCodeUserAddressForm" aria-label="Estado *">
                        @forelse ($this->userAddressForm->catalogStates as $index => $catalogState)
                            <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option>
                        @empty
                            <option selected>Selecciona una opción</option>
                        @endforelse
                    </select>

                    <label for="forms-user-address-state">Estado *</label>
                    <div wire:loading wire:target="postalCode"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo estados, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model="userAddressForm.municipality" aria-describedby="formsUserAddressMunicipality" wire:loading.attr="disabled" wire:target="postalCodeUserAddressForm" aria-label="Municipio *">
                        @forelse ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality)
                            <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option>
                        @empty
                            <option selected>Selecciona una opción</option>
                        @endforelse
                    </select>

                    <label for="forms-user-address-municipality">Municipio *</label>
                    <div wire:loading wire:target="postalCode"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.colony') is-invalid @enderror" id="forms-user-address-colony" wire:model="userAddressForm.colony" aria-describedby="formsUserAddressColony" wire:loading.attr="disabled" wire:target="postalCodeUserAddressForm" aria-label="Colonia *">
                        @if (empty($this->userAddressForm->catalogColonies) || count($this->userAddressForm->catalogColonies) > 1) <option selected>Selecciona una opción</option> @endif
                        @foreach ($this->userAddressForm->catalogColonies as $index => $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-colony">Colonia *</label>
                    <div wire:loading wire:target="postalCode"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo colonias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.colony') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(3)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *">
                    <label for="forms-user-address-address">Dirección *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>

                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Departamento *</label>

                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model.live="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Provincia *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo provincias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.colony') is-invalid @enderror" id="forms-user-address-colony" wire:model="userAddressForm.colony" wire:loading.attr="disabled" wire:target="stateUserAddressForm, municipalityUserAddressForm" aria-describedby="formsUserAddressColony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogColonies as $index => $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-colony">Distrito *</label>
                    <div wire:loading wire:target="municipalityUserAddressForm"><div id="formsUserAddressColony" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.colony') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(4)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *">
                    <label for="forms-user-address-address">Dirección *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>

                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Provincia *</label>

                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model.live="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Ciudad *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.colony') is-invalid @enderror" id="forms-user-address-colony" wire:model="userAddressForm.colony" wire:loading.attr="disabled" wire:target="stateUserAddressForm, municipalityUserAddressForm" aria-describedby="formsUserAddressColony" aria-label="Parroquia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogColonies as $index => $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-colony">Parroquia *</label>
                    <div wire:loading wire:target="municipalityUserAddressForm"><div id="formsUserAddressColony" class="form-text">Obteniendo parroquias, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.colony') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(5)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *">
                    <label for="forms-user-address-address">Dirección *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>
                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Provincia *</label>

                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model.live="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Distrito *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.colony') is-invalid @enderror" id="forms-user-address-colony" wire:model="userAddressForm.colony" wire:loading.attr="disabled" wire:target="stateUserAddressForm, municipalityUserAddressForm" aria-describedby="formsUserAddressColony" aria-label="Corregimiento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogColonies as $index => $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-colony">Corregimiento *</label>
                    <div wire:loading wire:target="municipalityUserAddressForm"><div id="formsUserAddressColony" class="form-text">Obteniendo corregimientos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.colony') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(6)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *">
                    <label for="forms-user-address-address">Dirección *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>
                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Departamento *</label>

                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model.live="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Municipio *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(7)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *">
                    <label for="forms-user-address-address">Dirección *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>
                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm"  wire:loading.attr="disabled" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Departamento *</label>

                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model.live="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Municipio *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo municipios, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(8)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Dirección *">
                    <label for="forms-user-address-address">Dirección *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia" aria-describedby="formsUserAddressCountryReference">
                    <label for="forms-user-address-reference-address">Referencia</label>
                    <div id="formsUserAddressCountryReference" class="form-text">(Indicaciones o comentarios adicionales).</div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm"  wire:loading.attr="disabled" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Provincia *</label>

                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.state') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model.live="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Cantón *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Cantón *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo cantones, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.colony') is-invalid @enderror" id="forms-user-address-colony" wire:model="userAddressForm.colony" wire:loading.attr="disabled" wire:target="stateUserAddressForm, municipalityUserAddressForm" aria-describedby="formsUserAddressColony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogColonies as $index => $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-colony">Distrito *</label>
                    <div wire:loading wire:target="municipalityUserAddressForm"><div id="formsUserAddressColony" class="form-text">Obteniendo distritos, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.colony') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break

    @case(10)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.addressee') is-invalid @enderror" id="forms-user-address-addressee" wire:model="userAddressForm.addressee" placeholder="Destinatario *">
                    <label for="forms-user-address-addressee">Destinatario *</label>

                    @error('userAddressForm.addressee') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.email') is-invalid @enderror" id="forms-user-address-email" wire:model="userAddressForm.email" placeholder="Correo Electrónico *">
                    <label for="forms-user-address-email">Correo Electrónico *</label>

                    @error('userAddressForm.email') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.cellphone') is-invalid @enderror" id="forms-user-address-cellphone" wire:model="userAddressForm.cellphone" placeholder="Teléfono Celular *">
                    <label for="forms-user-address-cellphone">Teléfono Celular *</label>

                    @error('userAddressForm.cellphone') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="forms-user-address-phone" wire:model="userAddressForm.phone" placeholder="Teléfono Fijo">
                    <label for="forms-user-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.address') is-invalid @enderror" id="forms-user-address-address" wire:model="userAddressForm.address" placeholder="Calle *">
                    <label for="forms-user-address-address">Calle *</label>

                    @error('userAddressForm.address') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.complementAddress') is-invalid @enderror" id="forms-user-address-complement-address" wire:model="userAddressForm.complementAddress" placeholder="Número *">
                    <label for="forms-user-address-complement-address">Número *</label>

                    @error('userAddressForm.complementAddress') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.referenceAddress') is-invalid @enderror" id="forms-user-address-reference-address" wire:model="userAddressForm.referenceAddress" placeholder="Referencia *">
                    <label for="forms-user-address-reference-address">Referencia *</label>

                    @error('userAddressForm.referenceAddress') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('userAddressForm.postalCode') is-invalid @enderror" id="forms-user-address-postal-code" wire:model="userAddressForm.postalCode" placeholder="Código Postal">
                    <label for="forms-user-address-postal-code">Código Postal</label>

                    @error('userAddressForm.postalCode') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('stateUserAddressForm') is-invalid @enderror @error('userAddressForm.state') is-invalid @enderror" id="forms-user-address-state" wire:model.live="stateUserAddressForm"  wire:loading.attr="disabled" aria-label="Región *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogStates as $index => $catalogState) <option value="{{ $catalogState['CodigoDir_1'] }}|{{ $catalogState['Direccion_1'] }}">{{ $catalogState['Direccion_1'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-state">Región *</label>
                    @error('stateUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('municipalityUserAddressForm') is-invalid @enderror @error('userAddressForm.municipality') is-invalid @enderror" id="forms-user-address-municipality" wire:model.live="municipalityUserAddressForm" wire:loading.attr="disabled" wire:target="stateUserAddressForm" aria-describedby="formsUserAddressMunicipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogMunicipalities as $index => $catalogMunicipality) <option value="{{ $catalogMunicipality['CodigoDir_2'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogMunicipality['Direccion_2'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-municipality">Ciudad *</label>
                    <div wire:loading wire:target="stateUserAddressForm"><div id="formsUserAddressMunicipality" class="form-text">Obteniendo ciudades, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('municipalityUserAddressForm') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                    @error('userAddressForm.municipality') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select @error('userAddressForm.colony') is-invalid @enderror" id="forms-user-address-colony" wire:model="userAddressForm.colony" wire:loading.attr="disabled" wire:target="stateUserAddressForm, municipalityUserAddressForm" aria-describedby="formsUserAddressColony" aria-label="Comuna *">
                        <option selected>Selecciona una opción</option>
                        @foreach ($this->userAddressForm->catalogColonies as $index => $catalogColony) <option value="{{ $catalogColony['CodigoDir_3'] }}|{{ $catalogMunicipality['Direccion_2'] }}">{{ $catalogColony['Direccion_3'] }}</option> @endforeach
                    </select>

                    <label for="forms-user-address-colony">Comuna *</label>
                    <div wire:loading wire:target="municipalityUserAddressForm"><div id="formsUserAddressColony" class="form-text">Obteniendo comunas, espera por favor... <i class="fa-solid fa-circle-notch fa-spin position-relative ms-1 custom i-top-5"></i></div></div>

                    @error('userAddressForm.colony') <div class="invalid-feedback d-inline-block"><strong>{{ $message }}</strong></div> @enderror
                </div>
            </div>
        </div>
        @break
    @default
@endswitch

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="forms-user-address-save" wire:model="userAddressForm.saveNewAddress">
    <label class="form-check-label text-muted" for="forms-user-address-save">Guardar dirección para futuras compras.</label>
</div>

@switch($this->country['id'])
    @case(1)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-complement" placeholder="Complemento">
                    <label for="checkout-address-complement">Complemento</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Ciudad *</label>
                </div>
            </div>
        </div>
        @break

    @case(2)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-postal-code" placeholder="Código Postal *">
                    <label for="checkout-address-postal-code">Código Postal *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Estado *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Estado *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Municipio *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" aria-label="Colonia *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-colony">Colonia *</label>
                </div>
            </div>
        </div>
        @break

    @case(3)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-colony">Distrito *</label>
                </div>
            </div>
        </div>
        @break

    @case(4)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Ciudad *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" aria-label="Parroquia *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-colony">Parroquia *</label>
                </div>
            </div>
        </div>
        @break

    @case(5)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Distrito *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" aria-label="Corregimiento *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-colony">Corregimiento *</label>
                </div>
            </div>
        </div>
        @break

    @case(6)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Municipio *</label>
                </div>
            </div>
        </div>
        @break

    @case(7)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Departamento *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Departamento *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Municipio *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Municipio *</label>
                </div>
            </div>
        </div>
        @break

    @case(8)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Dirección *">
                    <label for="checkout-address-address">Dirección *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia">
                    <label for="checkout-address-reference">Referencia</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Provincia *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Provincia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Cantón *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Cantón *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" aria-label="Distrito *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-colony">Distrito *</label>
                </div>
            </div>
        </div>
        @break

    @case(10)
        <div class="row gx-3">
            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-addresses" placeholder="Destinatario *">
                    <label for="checkout-address-addresses">Destinatario *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-email" placeholder="Correo Electrónico *">
                    <label for="checkout-address-email">Correo Electrónico *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-cellular" placeholder="Teléfono Celular *">
                    <label for="checkout-address-cellular">Teléfono Celular *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-phone" placeholder="Teléfono Fijo">
                    <label for="checkout-address-phone">Teléfono Fijo</label>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-address" placeholder="Calle *">
                    <label for="checkout-address-address">Calle *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-complement" placeholder="Número *">
                    <label for="checkout-address-complement">Número *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-reference" placeholder="Referencia *">
                    <label for="checkout-address-reference">Referencia *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="checkout-address-postal-code" placeholder="Código Postal *">
                    <label for="checkout-address-postal-code">Código Postal *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-state" aria-label="Región *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-state">Región *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-municipality" aria-label="Ciudad *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-municipality">Ciudad *</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="checkout-address-colony" aria-label="Comuna *">
                        <option selected>Selecciona una opción</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="checkout-address-colony">Comuna *</label>
                </div>
            </div>
        </div>
        @break
    @default
@endswitch


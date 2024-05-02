<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use GuzzleHttp\Client;
use Livewire\Attributes\Locked;

class UserAddressForm extends Form
{
    #[Locked]
    public array $catalogCountry = [];

    #[Locked]
    public array $catalogStates = [];

    #[Locked]
    public array $catalogMunicipalities = [];

    #[Locked]
    public array $catalogColonies = [];

    #[Locked]
    public int $countUserAddresses = 0;

    #[Locked]
    public int $selectedUserAddress;

    #[Locked]
    public string $state;

    #[Locked]
    public string $municipality;

    #[Locked]
    public string $colony;

    #[Locked]
    public string $postalCode;

    public string $addressee;
    public string $email;
    public string $cellphone;
    public string $phone;
    public string $address;
    public string $complementAddress;
    public string $referenceAddress;
    public int $addressSelectionType = 0;
    public bool $saveNewAddress = true;

    public function getCountUserAddresses() {
        //Obtener la cantidad de direcciones registradas por el usuario
        $this->countUserAddresses = auth()->user()->userAddresses()
        ->catalogCountryId($this->catalogCountry['id'])
        ->status()
        ->count();
    }

    public function changeAddressSelectionType(int $addressSelectionType) {
        //Cambiar tipo de dirección (Nueva / Existente)
        $this->addressSelectionType = $addressSelectionType;
    }

    public function getApiCatalogStates() {
        //Iniciar petición
        $client = new Client();

        try {
            //Generar petición
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->catalogCountry['abbrev'],
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if ($responseData['status'] == 200) {
                    if (in_array($this->catalogCountry['id'], [5, 8])) {
                        //Guardar catálogo de estados para Panamá y Costa Rica
                        $this->catalogStates = $responseData['dataDir']['provincia'];
                    } else if ($this->catalogCountry['id'] == 10) {
                        //Guardar catálogo de estados para Chile
                        $this->catalogStates = $responseData['dataDir']['region'];
                    } else if (in_array($this->catalogCountry['id'], [6, 7])) {
                        //Guardar catálogo de estados para Guatemala y el Salvador
                        $this->catalogStates = $responseData['dataDir']['departamento'];
                    } else {
                        //Guardar catálogo de estados para el resto de los países
                        $this->catalogStates = $responseData['dataDir']['departamentos'];
                    }
                }
            }
        } catch (\Exception) {}
    }

    public function getApiCatalogMunicipalities() {
        //Obtener código del estado
        $stateCode = explode('|', $this->state)[0];

        //Iniciar petición
        $client = new Client();

        try {
            //Generar petición
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->catalogCountry['abbrev'] . '&d[f]=' . $stateCode,
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if ($responseData['status'] == 200) {
                    if (in_array($this->catalogCountry['id'], [1, 10])) {
                        //Guardar catálogo de municipios en Colombia y Chile
                        $this->catalogMunicipalities = $responseData['dataDir']['ciudad'];
                    } else if ($this->catalogCountry['id'] == 5) {
                        //Guardar catálogo de municipios en Panamá
                        $this->catalogMunicipalities = $responseData['dataDir']['distrito'];
                    } else if (in_array($this->catalogCountry['id'], [6, 7])) {
                        //Guardar catálogo de municipios en Guatemala y el Salvador
                        $this->catalogMunicipalities = $responseData['dataDir']['municipio'];
                    } else if ($this->catalogCountry['id'] == 8) {
                        //Guardar catálogo de municipios en Costa Rica
                        $this->catalogMunicipalities = $responseData['dataDir']['canton'];
                    } else {
                        //Guardar catálogo de municipios en el resto de los países
                        $this->catalogMunicipalities = $responseData['dataDir']['provincias'];
                    }
                }
            }
        } catch (\Exception) {}
    }

    public function getApiCatalogColonies() {
        //Obtener código del estado
        $stateCode = explode('|', $this->state)[0];

        //Obtener código del municipio
        $municipalityCode = explode('|', $this->municipality)[0];

        //Iniciar petición
        $client = new Client();

        try {
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->catalogCountry['abbrev'] . '&d[f]=' . $stateCode . '&d[f2]=' . $municipalityCode,
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if ($responseData['status'] == 200) {
                    if ($this->catalogCountry['id'] == 5) {
                        //Guardar catálogo de colonias para Panamá
                        $this->catalogColonies = $responseData['dataDir']['corregimiento'];
                    } else if ($this->catalogCountry['id'] == 8) {
                        //Guardar catálogo de colonias para Costa Rica
                        $this->catalogColonies = $responseData['dataDir']['distrito'];
                    } else if ($this->catalogCountry['id'] == 10) {
                        //Guardar catálogo de colonias para Chile
                        $this->catalogColonies = $responseData['dataDir']['comuna'];
                    } else {
                        //Guardar catálogo de colonias para el resto de los países
                        $this->catalogColonies = $responseData['dataDir']['distritos'];
                    }
                }
            }
        } catch (\Exception) {}
    }

    public function getApiCatalogs() {
        //Iniciar petición
        $client = new Client();

        try {
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->catalogCountry['abbrev'] . '&d[f]=' . $this->postalCode,
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if ($responseData['status'] == 200) {
                    foreach ($responseData['dataDir'] as $catalog) {
                        //Guardar catálogos
                        $this->catalogStates[] = [ 'Direccion_1' => $catalog['Direccion_1'], 'CodigoDir_1' => $catalog['CodigoDir_1'] ];
                        $this->catalogMunicipalities[] = [ 'Direccion_2' => $catalog['Direccion_2'], 'CodigoDir_2' => $catalog['CodigoDir_2'] ];
                        $this->catalogColonies[] = [ 'Direccion_3' => $catalog['Direccion_3'], 'CodigoDir_3' => $catalog['CodigoDir_3'] ];

                        //Eliminar registros duplicados en catálogos
                        $this->catalogStates = array_map('unserialize', array_unique(array_map('serialize', $this->catalogStates)));
                        $this->catalogMunicipalities = array_map('unserialize', array_unique(array_map('serialize', $this->catalogMunicipalities)));
                        $this->catalogColonies = array_map('unserialize', array_unique(array_map('serialize', $this->catalogColonies)));
                    }
                }
            }
        } catch (\Exception) {}
    }

    public function validateAddress() {
        switch ($this->catalogCountry['id']) {
            case 1:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'departamento',
                    'municipality' => 'ciudad',
                ]);

                break;
            case 2:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:60',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                    'colony' => 'required|string|max:255',
                    'postalCode' => 'required|string|max:5|min:5',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'estado',
                    'municipality' => 'municipio',
                    'colony' => 'colonia',
                    'postalCode' => 'código postal',
                ]);

                break;
            case 3:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                    'colony' => 'required|string|max:255',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'departamento',
                    'municipality' => 'provincia',
                    'colony' => 'distrito'
                ]);

                break;
            case 4:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                    'colony' => 'required|string|max:255',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'provincia',
                    'municipality' => 'ciudad',
                    'colony' => 'parroquia'
                ]);

                break;
            case 5:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                    'colony' => 'required|string|max:255',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'provincia',
                    'municipality' => 'distrito',
                    'colony' => 'corregimiento'
                ]);

                break;
            case 6:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'departamento',
                    'municipality' => 'municipio',
                ]);

                break;
            case 7:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'departamento',
                    'municipality' => 'municipio',
                ]);

                break;
            case 8:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                    'colony' => 'required|string|max:255',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'dirección',
                    'state' => 'provincia',
                    'municipality' => 'cantón',
                    'colony' => 'distrito'
                ]);

                break;
            case 10:
                $this->validate([
                    'addressee' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'cellphone' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'municipality' => 'required|string|max:255',
                    'colony' => 'required|string|max:255',
                    'postalCode' => 'required|string|max:7|min:7',
                ], [], [
                    'addressee' => 'destinatario',
                    'email' => 'correo electrónico',
                    'cellphone' => 'teléfono celular',
                    'address' => 'calle',
                    'complementAddress' => 'número',
                    'referenceAddress' => 'referencia',
                    'state' => 'región',
                    'municipality' => 'ciudad',
                    'colony' => 'comuna'
                ]);

                break;
            default: break;
        }
    }
}

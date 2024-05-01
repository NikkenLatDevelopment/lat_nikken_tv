<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use GuzzleHttp\Client;
use Livewire\Attributes\Locked;

class AddressForm extends Form
{
    #[Locked]
    public array $country = [];

    #[Locked]
    public array $catalogStates = [];

    #[Locked]
    public array $catalogMunicipalities = [];

    #[Locked]
    public array $catalogColonies = [];

    public bool $saveAddress = true;

    public function getCatalogStates() {
        //Iniciar petición
        $client = new Client();

        try {
            //Generar petición
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->country['abbrev'],
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if ($responseData['status'] == 200) {
                    if (in_array($this->country['id'], [5, 8])) {
                        //Guardar catálogo de estados para Panamá y Costa Rica
                        $this->catalogStates = $responseData['dataDir']['provincia'];
                    } else if ($this->country['id'] == 10) {
                        //Guardar catálogo de estados para Chile
                        $this->catalogStates = $responseData['dataDir']['region'];
                    } else if (in_array($this->country['id'], [6, 7])) {
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

    public function getCatalogMunicipalities(string $state) {
        //Limpiar catálogo de municipios
        $this->catalogMunicipalities = [];

        //Obtener código del estado
        $state = explode('|', $state)[0];

        //Iniciar petición
        $client = new Client();

        try {
            //Generar petición
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->country['abbrev'] . '&d[f]=' . $state,
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if ($responseData['status'] == 200) {
                    if (in_array($this->country['id'], [1, 10])) {
                        //Guardar catálogo de municipios en Colombia y Chile
                        $this->catalogMunicipalities = $responseData['dataDir']['ciudad'];
                    } else if ($this->country['id'] == 5) {
                        //Guardar catálogo de municipios en Panamá
                        $this->catalogMunicipalities = $responseData['dataDir']['distrito'];
                    } else if (in_array($this->country['id'], [6, 7])) {
                        //Guardar catálogo de municipios en Guatemala y el Salvador
                        $this->catalogMunicipalities = $responseData['dataDir']['municipio'];
                    } else if ($this->country['id'] == 8) {
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

    public function getCatalogColonies(string $state, string $municipality) {
        //Limpiar catálogo de colonias
        $this->catalogColonies = [];

        //Obtener código del estado
        $state = explode('|', $state)[0];

        //Obtener código del municipio
        $municipality = explode('|', $municipality)[0];

        //Iniciar petición
        $client = new Client();

        try {
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->country['abbrev'] . '&d[f]=' . $state . '&d[f2]=' . $municipality,
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if ($responseData['status'] == 200) {
                    if ($this->country['id'] == 5) {
                        //Guardar catálogo de colonias para Panamá
                        $this->catalogColonies = $responseData['dataDir']['corregimiento'];
                    }else if ($this->country['id'] == 8) {
                        //Guardar catálogo de colonias para Costa Rica
                        $this->catalogColonies = $responseData['dataDir']['distrito'];
                    }else if ($this->country['id'] == 10) {
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

    public function getCatalogMex(int $postalCode) {
        //Limpiar catálogo estados
        $this->catalogStates = [];

        //Limpiar catálogo municipios
        $this->catalogMunicipalities = [];

        //Limpiar catálogo colonias
        $this->catalogColonies = [];

        //Iniciar petición
        $client = new Client();

        try {
            $response = $client->request('GET',
                'https://services.nikken.com.mx/api_service?s=getDataCatalogDirecciones2023&d[country]=' . $this->country['abbrev'] . '&d[f]=' . $postalCode,
                [ 'headers' => [ 'Content-Type' => 'application/json' ] ]
            );

            //Validar estatus de la API
            $statusCode = $response->getStatusCode();

            if($statusCode == 200){
                //Obtener datos
                $data = $response->getBody();
                $responseData = json_decode($data, true);

                if($responseData['status'] == 200){
                    //Recorrer catálogos
                    foreach ($responseData['dataDir'] as $catalog) {
                        //Guardar catálogos
                        $this->catalogStates[] = [ 'Direccion_1' => $catalog['Direccion_1'], 'CodigoDir_1' => $catalog['CodigoDir_1'] ];
                        $this->catalogMunicipalities[] = [ 'Direccion_2' => $catalog['Direccion_2'], 'CodigoDir_2' => $catalog['CodigoDir_2'] ];
                        $this->catalogColonies[] = [ 'Direccion_3' => $catalog['Direccion_3'], 'CodigoDir_3' => $catalog['CodigoDir_3'] ];

                        //Eliminar registros duplicados
                        $this->catalogStates = array_map('unserialize', array_unique(array_map('serialize', $this->catalogStates)));
                        $this->catalogMunicipalities = array_map('unserialize', array_unique(array_map('serialize', $this->catalogMunicipalities)));
                        $this->catalogColonies = array_map('unserialize', array_unique(array_map('serialize', $this->catalogColonies)));
                    }
                }
            }
        } catch (\Exception) {}
    }
}

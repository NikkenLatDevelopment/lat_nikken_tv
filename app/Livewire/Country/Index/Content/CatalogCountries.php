<?php

namespace App\Livewire\Country\Index\Content;

use Livewire\Component;
use App\Models\CatalogCountry;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class CatalogCountries extends Component
{
    #[Locked]
    public array $catalogCountries = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.country.index.content.catalog-countries');
    }

    public function mount() {
        //Obtener catálogo de países
        $this->catalogCountries = CatalogCountry::select('id', 'code', 'name')
        ->status()
        ->orderBy('name', 'asc')
        ->get()
        ->toArray();
    }

    public function update(int $countryId, SessionController $sessionController) {
        //Validar información
        Validator::make(
            [ 'countryId' => $countryId ],
            [ 'countryId' => 'required|integer|exists:catalog_countries,id' ]
        )->validate();

        //Buscar país
        $country = CatalogCountry::sessionData()
        ->closed()
        ->status()
        ->find($countryId);

        if ($country) {
            //Guardar país en sesión
            $sessionController->setCountry($country->toArray());

            //Redireccionar
            return redirect()->route('home');
        }

        //Mostrar modal
        $this->dispatch('country.index.modal.closing-message.initialize', countryId: $countryId);
    }
}

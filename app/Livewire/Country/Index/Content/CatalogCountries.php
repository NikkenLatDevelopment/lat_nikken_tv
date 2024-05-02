<?php

namespace App\Livewire\Country\Index\Content;

use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use App\Models\CatalogCountry;

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

    public function update(int $catalogCountryId, SessionController $sessionController) {
        //Validar información
        if ($catalogCountryId <= 0) { return; }

        //Obtener información del país
        $catalogCountry = CatalogCountry::sessionData()
        ->closed()
        ->status()
        ->find($catalogCountryId);

        if ($catalogCountry) {
            //Guardar información del país en sesión y cookie
            $sessionController->setCatalogCountry($catalogCountry->toArray());

            //Redireccionar
            return redirect()->route('home');
        }

        //Emitir evento para mostrar mensaje de cierre
        $this->dispatch('country.index.modal.closing-message.initialize', catalogCountryId: $catalogCountryId);
    }
}

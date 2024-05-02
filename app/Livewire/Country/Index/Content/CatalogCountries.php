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

    public function update(int $id, SessionController $sessionController) {
        //Validar información
        if ($id <= 0) { return; }

        //Obtener información del país en sesión
        $catalogCountry = CatalogCountry::sessionData()
        ->closed()
        ->status()
        ->find($id);

        if ($catalogCountry) {
            //Guardar país en sesión
            $sessionController->setCatalogCountry($catalogCountry->toArray());

            //Redireccionar
            return redirect()->route('home');
        }

        //Emitir evento para mostrar mensaje de cierre
        $this->dispatch('country.index.modal.closing-message.initialize', id: $id);
    }
}

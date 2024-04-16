<?php

namespace App\Livewire\General\Header\Content\Main;

use Livewire\Component;
use App\Models\CatalogCountry;
use Livewire\Attributes\Locked;
use App\Models\SessionController;

class CatalogCountries extends Component
{
    #[Locked]
    public array $country = [];

    #[Locked]
    public array $catalogCountries = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.main.catalog-countries');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Obtener catálogo de países
        $this->catalogCountries = CatalogCountry::select('id', 'code', 'name')
        ->status()
        ->orderBy('name', 'asc')
        ->get()
        ->toArray();
    }
}

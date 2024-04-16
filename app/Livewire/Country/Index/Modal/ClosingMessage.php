<?php

namespace App\Livewire\Country\Index\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\CatalogCountry;
use Livewire\Attributes\Locked;

class ClosingMessage extends Component
{
    #[Locked]
    public string $closedMessage;

    public function render()
    {
        //Mostrar vista
        return view('livewire.country.index.modal.closing-message');
    }

    #[On('country.index.modal.closing-message.initialize')]
    public function initialize(int $catalog_country_id) {
        //Buscar país
        $catalogCountry = CatalogCountry::select('closed_message')
        ->status()
        ->find($catalog_country_id);

        if ($catalogCountry) {
            //Guardar mensaje
            $this->closedMessage = $catalogCountry->closed_message;

            //Mostrar modal
            $this->dispatch('countryIndexModalClosingMessage');
        }
    }
}

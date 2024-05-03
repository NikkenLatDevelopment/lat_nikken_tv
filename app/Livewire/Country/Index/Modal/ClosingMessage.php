<?php

namespace App\Livewire\Country\Index\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\CatalogCountry;

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
    public function initialize(int $catalogCountryId) {
        //Obtener información del país
        $catalogCountry = CatalogCountry::select('closed_message')
        ->status()
        ->find($catalogCountryId);

        if ($catalogCountry) {
            //Guardar mensaje de cierre
            $this->closedMessage = $catalogCountry->closed_message;

            //Emitir evento para mostrar mensaje de cierre
            $this->dispatch('countryIndexModalClosingMessage');
        }
    }
}

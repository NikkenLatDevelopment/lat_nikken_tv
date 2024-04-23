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
    public function initialize(int $countryId) {
        //Buscar país
        $country = CatalogCountry::select('closed_message')
        ->status()
        ->find($countryId);

        if ($country) {
            //Guardar mensaje
            $this->closedMessage = $country->closed_message;

            //Emitir evento para mostrar el mensaje de cierre
            $this->dispatch('countryIndexModalClosingMessage');
        }
    }
}

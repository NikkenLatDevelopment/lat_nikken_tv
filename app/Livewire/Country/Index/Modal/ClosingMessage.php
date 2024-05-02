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
    public function initialize(int $id) {
        //Obtener información del país
        $catalogCountry = CatalogCountry::select('closed_message')
        ->status()
        ->find($id);

        if ($catalogCountry) {
            //Guardar mensaje de cierre
            $this->closedMessage = $catalogCountry->closed_message;

            //Emitir evento para mostrar el mensaje de cierre
            $this->dispatch('countryIndexModalClosingMessage');
        }
    }
}

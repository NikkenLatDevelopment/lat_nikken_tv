<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class AvailableMessage extends Component
{
    #[Locked]
    public string $sku;

    #[Locked]
    public string $name;

    #[Locked]
    public string $availableUntil;

    #[Locked]
    public array $componentsNotAvailable = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.available-message');
    }

    #[On('product.show.modal.available-message.initialize')]
    public function initialize(string $sku, string $name, string $availableUntil, array $componentsNotAvailable) {
        //Inicializar información
        $this->sku = $sku;
        $this->name = $name;
        $this->availableUntil = $availableUntil;
        $this->componentsNotAvailable = $componentsNotAvailable;

        //Mostrar modal
        $this->dispatch('productShowModalAvailableMessage', view: 'show');
    }

    public function addCart() {
        //Cerrar modal
        $this->dispatch('productShowModalAvailableMessage', view: 'hide');

        //Emitir evento para agregar producto al carrito de compras
        $this->dispatch('product.show.content.main.addCart', available: 1);
    }
}

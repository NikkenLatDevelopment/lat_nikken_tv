<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class AvailableMessage extends Component
{
    #[Locked]
    public string $skuProduct;

    #[Locked]
    public string $nameProduct;

    #[Locked]
    public string $availableUntilProduct;

    #[Locked]
    public array $componentsNotAvailable = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.available-message');
    }

    #[On('product.show.modal.available-message.initialize')]
    public function initialize(string $skuProduct, string $nameProduct, string $availableUntilProduct, array $componentsNotAvailable) {
        //Inicializar información
        $this->skuProduct = $skuProduct;
        $this->nameProduct = $nameProduct;
        $this->availableUntilProduct = $availableUntilProduct;
        $this->componentsNotAvailable = $componentsNotAvailable;

        //Emitir evento para mostrar los productos en entrega postergada
        $this->dispatch('productShowModalAvailableMessage', view: 'show');
    }

    public function addCart() {
        //Emitir evento para cerrar los productos en entrega postergada
        $this->dispatch('productShowModalAvailableMessage', view: 'hide');

        //Emitir evento para agregar producto al carrito de compras
        $this->dispatch('product.show.content.main.addCart', available: 1);
    }
}

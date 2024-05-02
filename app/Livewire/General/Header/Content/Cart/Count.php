<?php

namespace App\Livewire\General\Header\Content\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class Count extends Component
{
    #[Locked]
    public int $count = 0;

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.cart.count');
    }

    #[On('general.header.content.cart.count.setCount')]
    public function setCount(int $count) {
        //Actualizar total de productos del carrito de compras
        $this->count = $count;
    }
}

<?php

namespace App\Livewire\General\Header\Content\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class Count extends Component
{
    #[Locked]
    public int $countProducts = 0;

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.cart.count');
    }

    #[On('general.header.content.cart.count.setCountProducts')]
    public function setCountProducts(int $countProducts) {
        //Actualizar total de productos del carrito de compras
        $this->countProducts = $countProducts;
    }
}

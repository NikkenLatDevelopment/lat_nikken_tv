<?php

namespace App\Livewire\General\Header\Content\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class Count extends Component
{
    #[Locked]
    public int $productsTotal = 0;

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.cart.count');
    }

    #[On('general.header.content.cart.count.getTotalProducts')]
    public function getTotalProducts(int $productsTotal) {
        //Actualizar contador carrito de compras
        $this->productsTotal = $productsTotal;
    }
}

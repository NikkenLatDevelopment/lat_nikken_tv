<?php

namespace App\Livewire\General\Header\Content\Wishlist;

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
        return view('livewire.general.header.content.wishlist.count');
    }

    #[On('general.header.content.wishlist.count.getTotalProducts')]
    public function getTotalProducts(int $productsTotal) {
        //Actualizar contador de productos
        $this->productsTotal = $productsTotal;
    }
}

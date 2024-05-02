<?php

namespace App\Livewire\General\Header\Content\Wishlist;

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
        return view('livewire.general.header.content.wishlist.count');
    }

    #[On('general.header.content.wishlist.count.setCount')]
    public function setCount(int $count) {
        //Actualizar total de productos de la lista de deseos
        $this->count = $count;
    }
}

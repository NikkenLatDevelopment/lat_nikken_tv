<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;

class Review extends Component
{
    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.review');
    }

    #[On('product.show.modal.review.initialize')]
    public function initialize(int $productId) {}
}

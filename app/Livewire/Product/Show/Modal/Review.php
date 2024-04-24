<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;

class Review extends Component
{
    #[Locked]
    public string $productName;

    public $rating = 5;

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.review');
    }

    #[On('product.show.modal.review.initialize')]
    public function initialize(int $productId, string $productName) {
        //Validar sesión del usuario
        if (!auth()->check()) { return; }

        //Validar información
        Validator::make(
            [ 'productId' => $productId ],
            [ 'productId' => 'required|integer|exists:products,id' ],
        )->validate();

        //Inicializar información
        $this->productName = $productName;

        //Emitir evento para crear el review
        $this->dispatch('productShowModalReview');
    }
}

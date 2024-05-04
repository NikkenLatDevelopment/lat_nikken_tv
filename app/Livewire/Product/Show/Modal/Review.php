<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;

class Review extends Component
{
    #[Locked]
    public int $productId;

    #[Locked]
    public string $productName;

    #[Validate('required|integer|between:1,5', as: 'calificación')]
    public int $rating = 5;

    #[Validate('required|string|max:255', as: 'experiencia')]
    public string $comment;

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.review');
    }

    #[On('product.show.modal.review.initialize')]
    public function initialize(int $productId, string $productName) {
        //Validar sesión
        if (!auth()->check()) { return; }

        //Validar información
        Validator::make(
            [
                'productId' => $productId,
                'productName' => $productName
            ],
            [
                'productId' => 'required|integer|exists:products,id',
                'productName' => 'required|string|max:255'
            ],
        )->validate();

        //Inicializar información
        $this->productId = $productId;
        $this->productName = $productName;

        //Emitir evento para crear el review del producto
        $this->dispatch('productShowModalReview', view: 'show');
    }

    public function create() {
        //Validar sesión
        if (!auth()->check()) { return; }

        //Validar información
        $this->validate();

        //Crear review del producto
        auth()->user()->productReviews()->create([ 'product_id' => $this->productId, 'rating' => $this->rating, 'comment' => $this->comment ]);

        //Emitir evento para refrescar la tabla de reviews
        $this->dispatch('product.show.table.review.refresh');

        //Emitir evento para cerrar el review
        $this->dispatch('productShowModalReview', view: 'hide');

        //Emitir evento para mostrar el mensaje
        $this->dispatch('showToast', message: '¡Gracias! Experiencia <span class="fw-bold"><u>compartida correctamente</u></span>.', color: 'success');

        //Limpiar información
        $this->reset();
    }
}

<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class ResumeProduct extends Component
{
    #[Locked]
    public int $id;

    public array $product = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.resume-product');
    }

    public function updatedProductQuantity() {
        //Emitir evento para actualizar la cantidad del producto en el carrito de compras
        $this->dispatch('checkout.index.content.main.changeQuantityProduct', id: $this->id, quantity: $this->product['quantity']);
    }

    #[On('checkout.index.content.resumeProduct.updateProduct.{id}')]
    public function updateProduct(array $product) {
        //Actualizar producto
        $this->product = $product;
    }
}

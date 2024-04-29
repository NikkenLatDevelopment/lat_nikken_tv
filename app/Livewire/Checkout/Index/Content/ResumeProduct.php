<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class ResumeProduct extends Component
{
    #[Locked]
    public int $productId;

    public array $product = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.resume-product');
    }

    public function updatedProductQuantity() {
        //Emitir evento para actualizar la cantidad del producto en el carrito de compras
        $this->dispatch('checkout.index.content.main.changeQuantity', productId: $this->productId, quantity: $this->product['quantity']);
    }

    #[On('checkout.index.content.resumeProduct.refreshProduct.{productId}')]
    public function refreshProduct(array $product) {
        //Actualizar producto del carrito de compras
        $this->product = $product;
    }
}

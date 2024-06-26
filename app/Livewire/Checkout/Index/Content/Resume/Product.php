<?php

namespace App\Livewire\Checkout\Index\Content\Resume;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class Product extends Component
{
    #[Locked]
    public int $productId;

    public array $product = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.resume.product');
    }

    public function updatedProductQuantity() {
        //Emitir evento para actualizar la cantidad del productos en el carrito de compras
        $this->dispatch('checkout.index.main.changeQuantityProduct', productId: $this->productId, quantity: $this->product['quantity']);
    }

    #[On('checkout.index.content.resume.product.update.{productId}')]
    public function update(array $product) {
        //Actualizar producto
        $this->product = $product;
    }
}

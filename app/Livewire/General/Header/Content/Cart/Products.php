<?php

namespace App\Livewire\General\Header\Content\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class Products extends Component
{
    #[Locked]
    public array $country = [];

    #[Locked]
    public array $products = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.cart.products');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Obtener carrito de compras
        $this->getProducts();
    }

    #[On('general.header.content.cart.products.getProducts')]
    public function getProducts() {
        //Emitir evento para actualizar el contador del carrito de compras
        $this->dispatch('general.header.content.cart.count.getTotalProducts', productsTotal: count($this->products));
    }
}

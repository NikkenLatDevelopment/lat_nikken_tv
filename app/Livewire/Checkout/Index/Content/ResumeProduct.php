<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class ResumeProduct extends Component
{
    #[Locked]
    public array $country = [];

    #[Locked]
    public int $index;

    public array $product = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.resume-product');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();
    }

    public function updatedProductQuantity() {
        //Validar información
        $validator = Validator::make(
            [ 'quantity' => $this->product['quantity'] ],
            [ 'quantity' => 'required|numeric|min:1|max:99' ]
        );

        if ($validator->fails()) {
            //Modificar cantidad del producto
            $this->product['quantity'] = $this->product['quantity'] - 1;
            return;
        }

        //Emitir evento para actualizar la cantidad del producto
        $this->dispatch('checkout.index.content.main.changeQuantity', index: $this->index, productId: $this->product['id'], quantity: $this->product['quantity'], DB: true);

        //Actualizar total del producto
        $this->product['totalText'] = formatPriceWithCurrency($this->product['price'] * $this->product['quantity'], $this->country);
    }
}

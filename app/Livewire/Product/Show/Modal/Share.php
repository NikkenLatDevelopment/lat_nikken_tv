<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;

class Share extends Component
{
    #[Locked]
    public string $productName;

    #[Locked]
    public string $currentUrl;

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.share');
    }

    #[On('product.show.modal.share.initialize')]
    public function initialize(string $productName, string $currentUrl) {
        //Validar información
        Validator::make(
            [
                'currentUrl' => $currentUrl,
                'productName' => $productName
            ],
            [
                'currentUrl' => 'required|string|max:255',
                'productName' => 'required|string|max:255'
            ],
        )->validate();

        //Inicializar información
        $this->productName = str_replace(' ', '%20', $productName);
        $this->currentUrl = str_replace('&', '%26', $currentUrl);

        //Emitir evento para mostrar el link para compartir
        $this->dispatch('productShowModalShare');
    }
}

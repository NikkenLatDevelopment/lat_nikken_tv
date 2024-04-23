<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class Share extends Component
{
    #[Locked]
    public string $name;

    #[Locked]
    public string $currentUrl;

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.share');
    }

    #[On('product.show.modal.share.initialize')]
    public function initialize(string $name, string $currentUrl) {
        //Inicializar información
        $this->name = str_replace(' ', '%20', $name);
        $this->currentUrl = str_replace('&', '%26', $currentUrl);

        //Mostrar modal
        $this->dispatch('productShowModalShare');
    }
}

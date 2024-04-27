<?php

namespace App\Livewire\Checkout\Index\Content;

use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Livewire\Attributes\Reactive;

class Resume extends Component
{
    #[Reactive]
    public array $products = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.checkout.index.content.resume');
    }
}

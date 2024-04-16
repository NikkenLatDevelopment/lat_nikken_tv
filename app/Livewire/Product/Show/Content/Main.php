<?php

namespace App\Livewire\Product\Show\Content;

use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\SessionController;

class Main extends Component
{
    #[Locked]
    public array $country = [];

    #[Locked]
    public array $product = [];

    #[Locked]
    public string $currentUrl;

    #[Locked]
    public int $product_id;

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.content.main');
    }

    public function mount(array $product, SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Obtener url actual
        $this->currentUrl = url()->current();

        //Inicializar producto
        $this->getProduct($product);
    }

    public function getProduct(array $product) {
        //Inicializar información
        $this->product = $product;
        $this->product_id = $product['id'];
    }
}

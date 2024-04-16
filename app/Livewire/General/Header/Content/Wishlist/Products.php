<?php

namespace App\Livewire\General\Header\Content\Wishlist;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    #[Locked]
    public array $products = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.wishlist.products');
    }

    public function mount(SessionController $sessionController) {
        //Obtener productos favoritos
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.wishlist.products.getProducts')]
    public function getProducts(SessionController $sessionController) {
        //Obtener información del país
        $country = $sessionController->getCountry()->toArray();

        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Obtener productos favoritos //TODO: !!!! Pendiente
        $this->products = $user->wishlists()
        ->where('catalog_country_id', $country['id'])
        ->get()
        ->toArray();

        //Emitir evento para actualizar el contador de los productos favoritos
        $this->dispatch('general.header.content.wishlist.count.getCount', count($this->products));
    }
}

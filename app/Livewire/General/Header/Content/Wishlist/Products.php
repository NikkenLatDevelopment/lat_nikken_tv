<?php

namespace App\Livewire\General\Header\Content\Wishlist;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\ProductComponent;
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
        //Obtener lista de deseos
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.wishlist.products.getProducts')]
    public function getProducts(SessionController $sessionController) {
        //Obtener información del país
        $country = $sessionController->getCountry()->toArray();

        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Obtener lista de deseos
        $this->products = $user->wishlists()
        ->with('product')
        ->whereHas('product', fn($query) => $query->active($country['id']))
        ->where('catalog_country_id', $country['id'])
        ->get()
        ->map(function($wishlist) use ($country) {
            return [
                'slug' => $wishlist->product->slug,
                'sku' => $wishlist->product->sku,
                'name' => $wishlist->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $wishlist->product->image,
                'price' => formatPriceWithCurrency($wishlist->product->suggested_price, $country),
                'available' => array_values($wishlist->product->getAvailability())[0],
                'rating' => $wishlist->product->rating_total,
            ];
        })
        ->toArray();

        //Emitir evento para actualizar el contador de la lista de deseos
        $this->dispatch('general.header.content.wishlist.count.getTotalProducts', count($this->products));
    }
}

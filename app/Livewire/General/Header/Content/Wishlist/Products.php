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

        //Obtener productos favoritos
        $this->products = $user->wishlists()
        ->with('product')
        ->whereHas('product', fn($query) => $query->active($country['id']))
        ->where('catalog_country_id', $country['id'])
        ->get()
        ->map(function($wishlist) use ($country) {
            $available = 1;

            //Obtener componentes
            $components = ProductComponent::with('product')
            ->where('parent_product_id', $wishlist->product->id)
            ->get()
            ->toArray();

            if (count($components) > 0) {
                //Recorrer componentes
                foreach ($components as $component) {
                    //Verificar inventario de los componentes
                    if ($component['product']['stock'] <= 0 && $component['product']['stock_applies'] == 1) {
                        //Marcar producto padre como no disponible
                        $available = 0;
                        break;
                    }
                }
            } else {
                //Verificar inventario del producto padre
                if ($this->product['stock'] <= 0 && $this->product['stock_applies'] == 1) {
                    //Marcar producto padre como no disponible
                    $available = 0;
                }
            }

            return [
                'slug' => $wishlist->product->slug,
                'sku' => $wishlist->product->sku,
                'name' => $wishlist->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $wishlist->product->image,
                'textSuggestedPrice' => formatPriceWithCurrency($wishlist->product->suggested_price, $country),
                'available' => $available
            ];
        })
        ->toArray();

        //Emitir evento para actualizar el contador de los productos favoritos
        $this->dispatch('general.header.content.wishlist.count.getTotalProducts', count($this->products));
    }
}

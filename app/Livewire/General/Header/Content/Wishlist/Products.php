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
    public array $country = [];

    #[Locked]
    public array $products = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.wishlist.products');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Obtener lista de deseos
        $this->getProducts($sessionController);
    }

    #[On('general.header.content.wishlist.products.getProducts')]
    public function getProducts() {
        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Obtener lista de deseos
        $this->products = $user->wishlists()
        ->with('product', 'product.catalogProductBrand')
        ->whereHas('product', fn($query) => $query->active($this->country['id']))
        ->where('catalog_country_id', $this->country['id'])
        ->get()
        ->map(function($wishlist) {
            return [
                'id' => $wishlist->product->id,
                'slug' => $wishlist->product->slug,
                'sku' => $wishlist->product->sku,
                'name' => $wishlist->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $wishlist->product->image,
                'price' => formatPriceWithCurrency($wishlist->product->suggested_price, $this->country),
                'available' => array_values($wishlist->product->getAvailability())[0],
                'rating' => $wishlist->product->rating_total,
                'brandSlug' => $wishlist->product->catalogProductBrand->slug
            ];
        })
        ->toArray();

        //Emitir evento para actualizar el contador de la lista de deseos
        $this->dispatch('general.header.content.wishlist.count.getTotalProducts', productsTotal: count($this->products));
    }

    public function removeProduct(int $productId) {
        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Eliminar producto de la lista de deseos
        $user->wishlists()->where('product_id', $productId)->delete();

        //Obtener lista de deseos
        $this->getProducts();

        //Mostrar mensaje
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu lista de deseos.', color: 'dark');

        //Emitir evento para actualizar desmarcar el producto en la lista de deseos
        $this->dispatch('product.show.content.main.removeWishlist', productId: $productId);
    }
}

<?php

namespace App\Livewire\General\Header\Content\Wishlist;

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
        return view('livewire.general.header.content.wishlist.products');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Obtener productos de la lista de deseos
        $this->getProducts();
    }

    #[On('general.header.content.wishlist.products.getProducts')]
    public function getProducts() {
        //Validar sesión del usuario
        if (!auth()->check()) { return; }

        //Obtener productos de la lista de deseos
        $this->products = auth()->user()->wishlists()
        ->with([
            'product',
            'product.catalogProductBrand',
            'product.productComponents.product' => fn ($query) => $query->availabilityData()
        ])
        ->whereHas('product', fn($query) => $query->active($this->country['id']))
        ->country($this->country['id'])
        ->get()
        ->map(function($wishlist) {
            return [
                'id' => $wishlist->product->id,
                'slug' => $wishlist->product->slug,
                'sku' => $wishlist->product->sku,
                'name' => $wishlist->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $wishlist->product->image,
                'price' => formatPriceWithCurrency($wishlist->product->suggested_price + $wishlist->product->vat_suggested_price, $this->country),
                'available' => array_values($wishlist->product->getAvailability($wishlist->product->productComponents->toArray()))[0],
                'rating' => $wishlist->product->rating_total,
                'brandSlug' => $wishlist->product->catalogProductBrand->slug
            ];
        })
        ->toArray();

        //Emitir evento para actualizar el contador de la lista de deseos
        $this->dispatch('general.header.content.wishlist.count.getTotalProducts', productsTotal: count($this->products));
    }

    public function removeProduct(int $productId) {
        //Verificar si el producto existe
        $index = array_search($productId, array_column($this->products, 'id'));
        if ($index === false) { return false; }

        //Validar sesión del usuario
        if (!auth()->check()) { return; }

        //Validar información
        Validator::make(
            [ 'productId' => $productId ],
            [ 'productId' => 'required|integer|exists:products,id' ]
        )->validate();

        //Eliminar producto de la lista de deseos
        auth()->user()->wishlists()
        ->where('product_id', $productId)
        ->country($this->country['id'])
        ->delete();

        //Eliminar producto de la lista de deseos
        unset($this->products[$index]);

        //Reorganizar índices
        $this->products = array_values($this->products);

        //Emitir evento para mostrar mensaje de confirmación
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu lista de deseos.', color: 'dark');

        //Emitir evento para actualizar el contador de la lista de deseos
        $this->dispatch('general.header.content.wishlist.count.getTotalProducts', productsTotal: count($this->products));

        //Emitir evento para eliminar el producto en la lista de deseos
        $this->dispatch('product.show.content.main.removeWishlist', productId: $productId);
    }
}

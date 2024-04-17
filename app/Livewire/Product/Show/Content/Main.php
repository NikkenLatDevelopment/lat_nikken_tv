<?php

namespace App\Livewire\Product\Show\Content;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Livewire\Attributes\Locked;
use App\Models\ProductComponent;
use App\Models\SessionController;
use Illuminate\Support\Facades\Auth;

class Main extends Component
{
    #[Locked]
    public array $country = [];

    #[Locked]
    public array $product = [];

    #[Locked]
    public array $images = [];

    #[Locked]
    public array $componentsAvailable = [];

    #[Locked]
    public array $componentsNotAvailable = [];

    #[Locked]
    public array $parentProduct = [];

    #[Locked]
    public string $currentUrl;

    #[Locked]
    public int $productId;

    #[Locked]
    public int $available = 1;

    #[Locked]
    public int $reviewsTotal = 0;

    #[Locked]
    public string $price;

    public bool $wishlist = false;

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.content.main');
    }

    public function mount(array $product, array $availability, SessionController $sessionController) {
        //Obtener información del país
        $this->country = $sessionController->getCountry()->toArray();

        //Obtener url actual
        $this->currentUrl = url()->current();

        //Inicializar producto
        $this->getProduct($product, $availability);
    }

    public function getProduct(array $product, array $availability) {
        //Inicializar información
        $this->product = $product;
        $this->productId = $product['id'];

        //Obtener disponibilidad y componentes
        list($this->available, $this->componentsAvailable, $this->componentsNotAvailable) =  array_values($availability);

        //Formatear precio sugerido con iva con símbolo de moneda
        $this->price = formatPriceWithCurrency($product['suggested_price'], $this->country);

        //Obtener imágenes
        $this->getImages();

        //Obtener de lista de deseos
        $this->getWishlist();

        //Obtener información del producto padre
        if ($product['parent_product_id'] != null) { $this->getParentProduct(); }

        //Obtener total de reviews
        $this->getTotalReviews();
    }

    public function getImages() {
        //Obtener imágenes
        $this->images = ProductImage::select('image')
        ->where('product_id', $this->productId)
        ->get()
        ->map(function ($image) {
            $image->image = env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $image->image;
            return $image;
        })
        ->pluck('image')
        ->toArray();

        //Complementar imágenes con imagen principal
        array_unshift($this->images, env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $this->product['image']);
    }

    public function getWishlist() {
        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Consultar producto
        $wishlist = $user->wishlists()
        ->where('catalog_country_id', $this->country['id'])
        ->where('product_id', $this->productId)
        ->first();

        //Verificar si se encuentra en la lista de deseos
        $this->wishlist = $wishlist ? true : false;
    }

    public function changeWishlist() {
        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Consultar producto
        $wishlist = $user->wishlists()
        ->where('catalog_country_id', $this->country['id'])
        ->where('product_id', $this->productId)
        ->first();

        if ($this->wishlist) {
            if (!$wishlist) {
                //Guardar producto en la lista de deseos
                $user->wishlists()->create([
                    'catalog_country_id' => $this->country['id'],
                    'product_id' => $this->productId
                ]);
            }

            //Mostrar mensaje
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>agregado</u></span> a tu lista de deseos.', color: 'success');

            //Mostrar lista de deseos
            $this->dispatch('showWishlist');
        } else {
            if ($wishlist) {
                //Eliminar producto
                $wishlist->delete();
            }

            //Mostrar mensaje
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu lista de deseos.', color: 'dark');
        }

        //Emitir evento para actualizar la lista de deseos
        $this->dispatch('general.header.content.wishlist.products.getProducts');
    }

    #[On('product.show.content.main.removeWishlist')]
    public function removeWishlist(int $productId) {
        if ($this->productId == $productId) {
            //Desmarcar producto en la lista de deseos
            $this->wishlist = false;
        }
    }

    public function getTotalReviews() {
        //Obtener el total de reviews
        $this->reviewsTotal = ProductReview::where('product_id', $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId)
        ->status()
        ->count();
    }

    public function getParentProduct() {
        //Obtener información del producto padre
        $parentProduct = Product::select('id', 'suggested_price')
        ->find($this->product['parent_product_id']);

        if ($parentProduct) {
            //Complementar información
            $this->parentProduct = array_merge($parentProduct->toArray(), [
                'price' => formatPriceWithCurrency($parentProduct['suggested_price'], $this->country),
                'percentage_discount' => number_format(100 - (($this->product['suggested_price'] * 100) / $parentProduct['suggested_price']), 0),
            ]);
        }
    }
}

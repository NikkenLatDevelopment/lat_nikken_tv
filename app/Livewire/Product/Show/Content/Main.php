<?php

namespace App\Livewire\Product\Show\Content;

use App\Models\Product;
use Livewire\Component;
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
    public int $product_id;

    #[Locked]
    public int $available = 1;

    #[Locked]
    public int $reviewsTotal = 0;

    #[Locked]
    public string $textSuggestedPrice;

    public bool $isFavorite = false;

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

        //Formatear precio sugerido
        $this->textSuggestedPrice = formatPriceWithCurrency($product['suggested_price'], $this->country);

        //Obtener imágenes
        $this->getImages();

        //Obtener componentes
        $this->getComponents();

        //Obtener favorito
        $this->getFavorite();

        //Obtener información del producto padre
        if ($product['parent_product_id'] != null) { $this->getParentProduct(); }

        //Obtener total de reviews
        $this->getTotalReviews();
    }

    public function getImages() {
        //Obtener imágenes
        $this->images = ProductImage::select('image')
        ->where('product_id', $this->product_id)
        ->get()
        ->map(function ($image) {
            $image->image = env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $image->image;
            return $image;
        })
        ->pluck('image')
        ->toArray();

        //Agregar imagen principal
        array_unshift($this->images, env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $this->product['image']);
    }

    public function getComponents() {
        //Consultar producto
        $product = Product::find($this->product_id);
        if (!$product) { return; }

        //Obtener componentes
        list($this->available, $this->componentsAvailable, $this->componentsNotAvailable) =  array_values($product->getComponents());
    }

    public function getFavorite() {
        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Consultar producto
        $wishlist = $user->wishlists()
        ->where('catalog_country_id', $this->country['id'])
        ->where('product_id', $this->product_id)
        ->first();

        //Verificar si se encuentra en los favoritos
        $this->isFavorite = $wishlist ? true : false;
    }

    public function favorite() {
        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Consultar producto
        $wishlist = $user->wishlists()
        ->where('catalog_country_id', $this->country['id'])
        ->where('product_id', $this->product_id)
        ->first();

        if ($this->isFavorite) {
            if (!$wishlist) {
                //Guardar producto en los favoritos
                $user->wishlists()->create([
                    'catalog_country_id' => $this->country['id'],
                    'product_id' => $this->product_id
                ]);
            }

            //Mostrar mensaje
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>agregado</u></span> a tu lista de deseos.', color: 'success');

            //Mostrar productos favoritos
            $this->dispatch('showWishlist');
        } else {
            if ($wishlist) {
                //Eliminar producto
                $wishlist->delete();
            }

            //Mostrar mensaje
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu lista de deseos.', color: 'dark');
        }

        //Emitir evento para actualizar productos favoritos
        $this->dispatch('general.header.content.wishlist.products.getProducts');
    }

    public function getTotalReviews() {
        //Obtener el total de reviews
        $this->reviewsTotal = ProductReview::where('product_id', $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->product_id)
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
                'text_suggested_price' => formatPriceWithCurrency($parentProduct['suggested_price'], $this->country),
                'percentage_difference' => number_format(100 - (($this->product['suggested_price'] * 100) / $parentProduct['suggested_price']), 0),
            ]);
        }
    }
}

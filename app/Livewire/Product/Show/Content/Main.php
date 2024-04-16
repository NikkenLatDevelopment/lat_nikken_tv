<?php

namespace App\Livewire\Product\Show\Content;

use Livewire\Component;
use App\Models\ProductImage;
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
    public array $components = [];

    #[Locked]
    public array $componentsAvailable = [];

    #[Locked]
    public array $componentsNotAvailable = [];

    #[Locked]
    public string $currentUrl;

    #[Locked]
    public int $product_id;

    #[Locked]
    public int $available = 1;

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

        //Obtener imágenes
        $this->getImages();

        //Obtener componentes
        $this->getComponents();

        //Obtener favorito
        $this->getFavorite();
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
        //Obtener componentes
        $this->components = ProductComponent::with([ 'product' => function ($query) { $query->select('id', 'sku', 'name', 'stock', 'stock_applies', 'available_until'); } ])
        ->where('parent_product_id', $this->product_id)
        ->get()
        ->toArray();

        if (count($this->components) > 0) {
            //Recorrer componentes
            foreach ($this->components as $component) {
                //Verificar inventario de los componentes
                if ($component['product']['stock'] <= 0 && $component['product']['stock_applies'] == 1) {
                    //Marcar producto padre como no disponible
                    $this->available = 0;

                    //Guardar componentes no disponibles
                    $this->componentsNotAvailable[] = [
                        'sku' => $component['product']['sku'],
                        'name' => $component['product']['name'],
                        'date' => $component['product']['available_until'] == null
                            ? 'Sin fecha estimada de disponibilidad'
                            : formatDateInSpanishLocale($component['product']['available_until']),
                    ];
                } else {
                    //Guardar componentes disponibles
                    $this->componentsAvailable[] = [
                        'sku' => $component['product']['sku'],
                        'name' => $component['product']['name'],
                    ];
                }
            }
        } else {
            //Verificar inventario del producto padre
            if ($this->product['stock'] <= 0 && $this->product['stock_applies'] == 1) {
                //Marcar producto padre como no disponible
                $this->available = 0;
            }
        }
    }

    public function getFavorite() {
        //Obtener información del usuario
        $user = Auth::user();
        if (!$user) { return; }

        //Consultar si se encuentra en los productos favoritos
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

        //Consultar si se encuentra en los productos favoritos
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
}

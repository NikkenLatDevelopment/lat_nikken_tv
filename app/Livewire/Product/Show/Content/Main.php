<?php

namespace App\Livewire\Product\Show\Content;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use App\Models\ProductMeasurement;
use App\Models\ProductPresentation;
use Illuminate\Support\Facades\Validator;

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
    public array $colors = [];

    #[Locked]
    public array $presentations = [];

    #[Locked]
    public array $measurements = [];

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

    #[Locked]
    public string $availableUntil;

    #[Locked]
    public array $differentiators = [];

    public bool $wishlist = false;
    public int $selectedColor;
    public int $selectedPresentation;
    public int $selectedMeasurement;
    public int $quantity = 1;

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
        $this->price = formatPriceWithCurrency($product['suggested_price'] + $product['vat_suggested_price'], $this->country);

        //Validar fecha de disponibilidad
        $this->availableUntil = $product['available_until'] == null
            ? 'Sin fecha estimada de disponibilidad'
            : formatDateInSpanishLocale($product['available_until']);

        //Organizar diferenciadores
        $this->differentiators = $this->product['differentiators'] != null
            ? explode('|', $product['differentiators'])
            : [];

        //Obtener imágenes
        $this->getImages();

        //Obtener de lista de deseos
        $this->getWishlist();

        //Obtener información del producto padre
        if ($product['parent_product_id'] != null) { $this->getParentProduct(); }

        //Obtener total de reviews
        $this->getTotalReviews();

        //Obtener colores
        $this->getColors();

        //Obtener presentaciones
        $this->getPresentations();

        //Obtener Medidas
        $this->getMeasurements();
    }

    public function updateProduct(int $productId) {
        //Obtener información del producto
        $product = Product::basicData()
        ->with([ 'catalogProductBrand' ])
        ->active($this->country['id'])
        ->find($productId);

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $this->product['catalog_product_brand']['slug']);
        }

        //Inicializar producto
        $this->getProduct($product->toArray(), $product->getAvailability());

        //Refrescar imágenes del producto
        $this->dispatch('refreshImages', images: $this->images);
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
        //Validar sesión del usuario
        if (!auth()->check()) { return; }

        //Consultar producto
        $wishlist = auth()->user()->wishlists()
        ->where('product_id', $this->productId)
        ->country($this->country['id'])
        ->first();

        //Verificar si se encuentra en la lista de deseos
        $this->wishlist = $wishlist ? true : false;
    }

    public function changeWishlist() {
        //Validar sesión del usuario
        if (!auth()->check()) { return; }

        //Consultar producto
        $wishlist = auth()->user()->wishlists()
        ->where('product_id', $this->productId)
        ->country($this->country['id'])
        ->first();

        if ($this->wishlist) {
            if (!$wishlist) {
                //Guardar producto en la lista de deseos
                auth()->user()->wishlists()->create([
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

    public function getColors() {
        //Obtener colores
        $this->colors = ProductColor::select('product_id', 'color')
        ->where('parent_product_id', $this->productId)
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar color por defecto
        if (count($this->colors) > 0) { $this->selectedColor = $this->productId; }
    }

    public function updatedSelectedColor() {
        //Validar información
        Validator::make(
            [ 'selectedColor' => $this->selectedColor ],
            [ 'selectedColor' => 'required|integer|exists:product_colors,parent_product_id' ]
        )->validate();

        //Actualizar producto según el color seleccionado
        $this->updateProduct($this->selectedColor);
    }

    public function getPresentations() {
        //Obtener presentaciones
        $this->presentations = ProductPresentation::select('product_id', 'presentation')
        ->where('parent_product_id', $this->productId)
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar presentación por defecto
        if (count($this->presentations) > 0) { $this->selectedPresentation = $this->productId; }
    }

    public function updatedSelectedPresentation() {
        //Validar información
        Validator::make(
            [ 'selectedPresentation' => $this->selectedPresentation ],
            [ 'selectedPresentation' => 'required|integer|exists:product_presentations,id' ]
        )->validate();

        //Actualizar producto según la presentación seleccionada
        $this->updateProduct($this->selectedPresentation);
    }

    public function getMeasurements() {
        //Obtener medidas
        $this->measurements = ProductMeasurement::select('product_id', 'measurement')
        ->where('parent_product_id', $this->productId)
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar medida por defecto
        if (count($this->measurements) > 0) { $this->selectedMeasurement = $this->productId; }
    }

    public function updatedSelectedMeasurement() {
        //Validar información
        Validator::make(
            [ 'selectedMeasurement' => $this->selectedMeasurement ],
            [ 'selectedMeasurement' => 'required|integer|exists:product_measurements,id' ]
        )->validate();

        //Actualizar producto según la medida seleccionada
        $this->updateProduct($this->selectedMeasurement);
    }

    #[On('product.show.content.main.addCart')]
    public function addCart(int $available, SessionController $sessionController) {
        //Validar disponibilidad del producto
        if ($this->available == 0 && $available == 0) {
            //Emitir evento para recordar productos no disponibles
            return $this->dispatch('product.show.modal.available-message.initialize',
                sku: $this->product['sku'],
                name: $this->product['name'],
                availableUntil: $this->availableUntil,
                componentsNotAvailable: $this->componentsNotAvailable
            );
        }

        //Validar información
        $this->validate([
            'quantity' => 'required|numeric|min:1|max:99',
            'selectedColor' => 'nullable|integer|exists:product_colors,product_id',
            'selectedPresentation' => 'nullable|integer|exists:product_presentations,product_id',
            'selectedMeasurement' => 'nullable|integer|exists:product_measurements,product_id',
        ]);

        //Guardar producto en el carrito de compras
        $sessionController->setCart($this->productId, $this->quantity);

        //Emitir evento para actualizar el carrito de compras
        $this->dispatch('general.header.content.cart.products.getProducts');

        //Mostrar carrito de compras
        $this->dispatch('showCart');

        //Mostrar mensaje
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>agregado</u></span> a tu carrito de compras.', color: 'success');
    }

    public function showShareModal() {
        //Mostrar modal
        $this->dispatch('product.show.modal.share.initialize', name: $this->product['name'], currentUrl: $this->currentUrl);
    }
}

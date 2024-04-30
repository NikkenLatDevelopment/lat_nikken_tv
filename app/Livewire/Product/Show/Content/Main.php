<?php

namespace App\Livewire\Product\Show\Content;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use App\Models\ProductReview;
use App\Models\ProductFeature;
use Livewire\Attributes\Locked;
use App\Models\ProductAttachment;
use App\Models\ProductTechnology;
use App\Models\SessionController;
use App\Models\ProductMeasurement;
use App\Models\ProductPart;
use App\Models\ProductReplacement;
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
    public array $differentiators = [];

    #[Locked]
    public array $technologies = [];

    #[Locked]
    public array $features = [];

    #[Locked]
    public array $attachments = [];

    #[Locked]
    public array $videos = [];

    #[Locked]
    public array $replacements = [];

    #[Locked]
    public array $parts = [];

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
        $this->getCurrentUrl();

        //Inicializar producto
        $this->getProduct($product, $availability);
    }

    public function getCurrentUrl() {
        //Obtener tienda personalizada
        $customStore = auth()->check()
        ? auth()->user()->customStore()->status()->first()
        : null;

        if ($customStore) {
            //Obtener url actual
            $url = parse_url(url()->current());

            //Obtener tienda personalizada
            $this->currentUrl = $url['scheme'] . '://' . $customStore->name . '.' . $url['host'] . $url['path'];
        } else {
            //Obtener url actual
            $this->currentUrl = url()->current();
        }
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

        //Obtener y organizar diferenciadores
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

        //Obtener tecnologías
        $this->getTechnologies();

        //Obtener características
        $this->getFeatures();

        //Obtener archivos adjuntos
        $this->getAttachments();

        //Obtener videos
        $this->getVideos();

        //Obtener repuestos
        $this->getReplacements();

        //Obtener partes
        $this->getParts();
    }

    public function updateProduct(int $productId) {
        //Obtener información del producto
        $product = Product::basicData()
        ->with([
            'catalogProductBrand',
            'productComponents.product' => fn ($query) => $query->availabilityData()
        ])
        ->active($this->country['id'])
        ->find($productId);

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $this->product['catalog_product_brand']['slug']);
        }

        //Inicializar producto
        $this->getProduct($product->toArray(), $product->getAvailability($product->productComponents->toArray()));

        //Emitir evento para refrescar imágenes del producto
        $this->dispatch('refreshImages', images: $this->images);
    }

    public function getImages() {
        //Obtener información de las imágenes
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

        //Obtener información de la lista de deseos
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

        //Obtener información de la lista de deseos
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

            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>agregado</u></span> a tu lista de deseos.', color: 'success');

            //Emitir evento para mostrar la lista de deseos
            $this->dispatch('showWishlist');
        } else {
            if ($wishlist) {
                //Eliminar producto de la lista de deseos
                $wishlist->delete();
            }

            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu lista de deseos.', color: 'dark');
        }

        //Emitir evento para actualizar la lista de deseos
        $this->dispatch('general.header.content.wishlist.products.getProducts');
    }

    #[On('product.show.content.main.removeWishlist')]
    public function removeWishlist(int $productId) {
        //Validar si el producto de la lista de deseos es el mismo
        if ($this->productId == $productId) {
            //Desmarcar producto en la lista de deseos
            $this->wishlist = false;
        }
    }

    public function getTotalReviews() {
        //Obtener id del producto o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId;

        //Obtener el total de reviews
        $this->reviewsTotal = ProductReview::where('product_id', $productId)
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
                'price' => formatPriceWithCurrency($parentProduct['suggested_price'] + $parentProduct['vat_suggested_price'], $this->country),
                'percentage_discount' => number_format(100 - ((($this->product['suggested_price'] + $parentProduct['vat_suggested_price']) * 100) / $parentProduct['suggested_price']), 0),
            ]);
        }
    }

    public function getColors() {
        //Obtener información de los colores
        $this->colors = ProductColor::select('product_id', 'color')
        ->where('parent_product_id', $this->productId)
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar color por defecto
        if (!empty($this->colors)) { $this->selectedColor = $this->productId; }
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
        //Obtener información de las presentaciones
        $this->presentations = ProductPresentation::select('product_id', 'presentation')
        ->where('parent_product_id', $this->productId)
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar presentación por defecto
        if (!empty($this->presentations)) { $this->selectedPresentation = $this->productId; }
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
        //Obtener información de las medidas
        $this->measurements = ProductMeasurement::select('product_id', 'measurement')
        ->where('parent_product_id', $this->productId)
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar medida por defecto
        if (!empty($this->measurements)) { $this->selectedMeasurement = $this->productId; }
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
            return $this->dispatch('product.show.modal.available-message.initialize', sku: $this->product['sku'], name: $this->product['name'], availableUntil: $this->availableUntil, componentsNotAvailable: $this->componentsNotAvailable);
        }

        //Validar información
        $this->validate([
            'quantity' => 'required|integer|min:1|max:99',
            'selectedColor' => 'nullable|integer|exists:product_colors,product_id',
            'selectedPresentation' => 'nullable|integer|exists:product_presentations,product_id',
            'selectedMeasurement' => 'nullable|integer|exists:product_measurements,product_id',
        ]);

        //Guardar producto en el carrito de compras
        $sessionController->setCart($this->productId, $this->quantity);

        //Emitir evento para actualizar el carrito de compras
        $this->dispatch('general.header.content.cart.products.getProducts');

        //Emitir evento para mostrar el carrito de compras
        $this->dispatch('showCart');

        //Emitir evento para mostrar el mensaje
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>agregado</u></span> a tu carrito de compras.', color: 'success');
    }

    public function getTechnologies() {
        //Obtener id del producto o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId;

        //Obtener información de las tecnologías
        $this->technologies = ProductTechnology::with([ 'catalogProductTechnology' ])
        ->whereHas('catalogProductTechnology', fn ($query) => $query->status())
        ->where('product_id', $productId)
        ->get()
        ->map(function ($technology) {
            return [
                'id' => $technology['catalogProductTechnology']['id'],
                'slug' => $technology['catalogProductTechnology']['slug'],
                'name' => $technology['catalogProductTechnology']['name'],
            ];
        })
        ->toArray();
    }

    public function getFeatures() {
        //Obtener id del producto o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId;

        //Obtener información de las características
        $this->features = ProductFeature::with([ 'catalogProductFeature' ])
        ->whereHas('catalogProductFeature', fn ($query) => $query->status())
        ->where('product_id', $productId)
        ->get()
        ->toArray();
    }

    public function getAttachments() {
        //Obtener id del producto o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId;

        //Obtener información de los archivos adjuntos
        $this->attachments = ProductAttachment::with([ 'catalogProductAttachment' => fn ($query) => $query->status() ])
        ->where('product_id', $productId)
        ->get()
        ->map(function ($file) {
            $file->file = env('STORAGE_PRODUCT_ATTACHMENT_PATH') . $file->file;
            return $file;
        })
        ->toArray();
    }

    public function getVideos() {
        //Obtener id del producto o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId;

        //Obtener información de los videos
        $this->videos = ProductVideo::select('url')
        ->where('product_id', $productId)
        ->get()
        ->toArray();
    }

    public function getReplacements() {
        //Obtener id del producto o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId;

        //Obtener información de los repuestos
        $this->replacements = ProductReplacement::with([ 'product', 'product.catalogProductBrand' ])
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->where('parent_product_id', $productId)
        ->get()
        ->map(function ($product) {
            return [
                'slug' => $product->product->slug,
                'sku' => $product->product->sku,
                'name' => $product->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $product->product->image,
                'price' => formatPriceWithCurrency($product->product->suggested_price + $product->product->vat_suggested_price, $this->country),
                'rating' => $product->product->rating_total,
                'brandSlug' => $product->product->catalogProductBrand->slug
            ];
        })
        ->toArray();
    }

    public function getParts() {
        //Obtener id del producto o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->productId;

        //Obtener información de las partes
        $this->parts = ProductPart::with([ 'product', 'product.catalogProductBrand' ])
        ->whereHas('product', fn ($query) => $query->active($this->country['id']))
        ->where('parent_product_id', $productId)
        ->get()
        ->map(function ($product) {
            return [
                'slug' => $product->product->slug,
                'sku' => $product->product->sku,
                'name' => $product->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $product->product->image,
                'price' => formatPriceWithCurrency($product->product->suggested_price + $product->product->vat_suggested_price, $this->country),
                'rating' => $product->product->rating_total,
                'brandSlug' => $product->product->catalogProductBrand->slug
            ];
        })
        ->toArray();
    }
}

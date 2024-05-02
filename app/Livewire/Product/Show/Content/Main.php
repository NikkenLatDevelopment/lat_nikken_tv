<?php

namespace App\Livewire\Product\Show\Content;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use App\Models\ProductReview;
use App\Models\ProductFeature;
use App\Models\ProductAttachment;
use App\Models\ProductTechnology;
use App\Models\ProductMeasurement;
use App\Models\ProductPart;
use App\Models\ProductReplacement;
use App\Models\ProductPresentation;

class Main extends Component
{
    #[Locked]
    public array $catalogCountry = [];

    #[Locked]
    public array $product = [];

    #[Locked]
    public array $parentProduct = [];

    #[Locked]
    public array $images = [];

    #[Locked]
    public array $componentAvailables = [];

    #[Locked]
    public array $componentNotAvailables = [];

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
    public int $id;

    #[Locked]
    public string $currentUrl;

    #[Locked]
    public int $available = 1;

    #[Locked]
    public string $availableUntil;

    #[Locked]
    public int $countReviewProduct = 0;

    #[Locked]
    public string $priceText;

    #[Locked]
    public string $vcText;

    #[Locked]
    public string $retailText;

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

    public function mount(array $product, SessionController $sessionController) {
        //Obtener información del país en sesión
        $this->catalogCountry = $sessionController->getCatalogCountry()->toArray();

        //Obtener url actual
        $this->getCurrentUrl();

        //Inicializar producto
        $this->getProduct($product);
    }

    public function getCurrentUrl() {
        //Obtener tienda personalizada del usuario
        $customStore = auth()->check()
        ? auth()->user()->userCustomStore()->status()->first()
        : null;

        if ($customStore) {
            //Obtener url actual
            $url = parse_url(url()->current());

            //Agregar tienda personalizada a la url actual
            $this->currentUrl = $url['scheme'] . '://' . $customStore->name . '.' . $url['host'] . $url['path'];
        } else {
            //Obtener url actual
            $this->currentUrl = url()->current();
        }
    }

    public function getProduct(array $product) {
        //Inicializar información
        $this->product = $product;
        $this->id = $product['id'];

        //Guardar disponibilidad y componentes del producto
        list($this->available, $this->componentAvailables, $this->componentNotAvailables) =  array_values($product['availability']);

        //Formatear precio sugerido con iva, VC y retail del producto con símbolo de moneda
        $this->priceText = formatPriceWithCurrency($product['suggested_price'] + $product['vat_suggested_price'], $this->catalogCountry);
        $this->vcText = formatPriceWithCurrency($product['vc'], $this->catalogCountry);
        $this->retailText = formatPriceWithCurrency($product['retail'], $this->catalogCountry);

        //Validar fecha de disponibilidad del producto
        $this->availableUntil = $product['available_until'] == null
            ? 'Sin fecha estimada de disponibilidad'
            : formatDateInSpanishLocale($product['available_until']);

        //Obtener diferenciadores del producto y organizarlos en un array
        $this->differentiators = $this->product['differentiators'] != null
            ? explode('|', $product['differentiators'])
            : [];

        //Obtener imágenes del producto
        $this->getImages();

        //Validar si el producto se encuentra en la lista de deseos
        $this->getWishlist();

        //Obtener información del producto padre
        if ($product['parent_product_id'] != null) { $this->getParentProduct(); }

        //Obtener total de reviews del producto
        $this->getTotalReviews();

        //Obtener colores del producto
        $this->getColors();

        //Obtener presentaciones del producto
        $this->getPresentations();

        //Obtener Medidas del producto
        $this->getMeasurements();

        //Obtener tecnologías del producto
        $this->getTechnologies();

        //Obtener características del producto
        $this->getFeatures();

        //Obtener archivos adjuntos del producto
        $this->getAttachments();

        //Obtener videos del producto
        $this->getVideos();

        //Obtener repuestos del producto
        $this->getReplacements();

        //Obtener partes del producto
        $this->getParts();
    }

    public function updateProduct(int $productId) {
        //Obtener información del producto
        $product = Product::basicData()
        ->with([
            'catalogProductBrand',
            'productComponents.product' => fn ($query) => $query->availabilityData()
        ])
        ->active($this->catalogCountry['id'])
        ->find($productId);

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $this->product['catalog_product_brand']['slug']);
        }

        //Obtener disponibilidad y componentes del producto
        $available = $product->getAvailability($product->productComponents->toArray());

        //Agregar disponibilidad y componentes a la información del producto
        $product['availability'] = $available;

        //Inicializar producto
        $this->getProduct($product->toArray());

        //Emitir evento para refrescar imágenes del producto
        $this->dispatch('refreshImages', images: $this->images);
    }

    public function getImages() {
        //Obtener información de las imágenes del producto
        $this->images = ProductImage::select('image')
        ->where('product_id', $this->id)
        ->get()
        ->map(function ($image) {
            $image->image = env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $image->image;
            return $image;
        })
        ->pluck('image')
        ->toArray();

        //Complementar imágenes del producto con la imagen principal del producto principal
        array_unshift($this->images, env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $this->product['image']);
    }

    public function getWishlist() {
        //Validar sesión del usuario
        if (!auth()->check()) { return; }

        //Obtener información de la lista de deseos
        $wishlist = auth()->user()->wishlists()
        ->where('product_id', $this->id)
        ->catalogCountryId($this->catalogCountry['id'])
        ->first();

        //Verificar si el producto se encuentra en la lista de deseos
        $this->wishlist = $wishlist ? true : false;
    }

    public function changeWishlist() {
        //Validar sesión del usuario
        if (!auth()->check()) { return; }

        //Obtener información de la lista de deseos
        $wishlist = auth()->user()->wishlists()
        ->where('product_id', $this->id)
        ->catalogCountryId($this->catalogCountry['id'])
        ->first();

        if ($this->wishlist) {
            //Guardar producto en la lista de deseos
            if (!$wishlist) { auth()->user()->wishlists()->create([ 'catalog_country_id' => $this->catalogCountry['id'], 'product_id' => $this->id ]); }

            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>agregado</u></span> a tu lista de deseos.', color: 'success');

            //Emitir evento para mostrar la lista de deseos
            $this->dispatch('showWishlist');
        } else {
            //Eliminar producto de la lista de deseos
            if ($wishlist) { $wishlist->delete();  }

            //Emitir evento para mostrar mensaje de confirmación
            $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>eliminado</u></span> de tu lista de deseos.', color: 'dark');
        }

        //Emitir evento para actualizar la lista de deseos del menú
        $this->dispatch('general.header.content.wishlist.products.getProducts');
    }

    #[On('product.show.content.main.removeWishlist')]
    public function removeWishlist(int $productId) {
        if ($this->id == $productId) {
            //Desmarcar producto de la lista de deseos
            $this->wishlist = false;
        }
    }

    public function getTotalReviews() {
        //Obtener ID del producto principal o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->id;

        //Obtener el total de reviews del producto
        $this->countReviewProduct = ProductReview::where('product_id', $productId)
        ->status()
        ->count();
    }

    public function getParentProduct() {
        //Obtener información del producto padre
        $parentProduct = Product::select('id', 'suggested_price')
        ->find($this->product['parent_product_id']);

        if ($parentProduct) {
            //Complementar información del producto padre
            $this->parentProduct = array_merge($parentProduct->toArray(), [
                'price_text' => formatPriceWithCurrency($parentProduct['suggested_price'] + $parentProduct['vat_suggested_price'], $this->catalogCountry),
                'percentage_discount' => number_format(100 - ((($this->product['suggested_price'] + $parentProduct['vat_suggested_price']) * 100) / $parentProduct['suggested_price']), 0),
            ]);
        }
    }

    public function getColors() {
        //Obtener información de los colores del producto
        $this->colors = ProductColor::select('product_id', 'color')
        ->where('parent_product_id', $this->id)
        ->whereHas('product', fn ($query) => $query->active($this->catalogCountry['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar color por defecto
        if (!empty($this->colors)) { $this->selectedColor = $this->id; }
    }

    public function updatedSelectedColor() {
        //Validar información
        Validator::make(
            [ 'selectedColor' => $this->selectedColor ],
            [ 'selectedColor' => 'required|integer|exists:product_colors,id' ]
        )->validate();

        //Actualizar producto según el color seleccionado
        $this->updateProduct($this->selectedColor);
    }

    public function getPresentations() {
        //Obtener información de las presentaciones del producto
        $this->presentations = ProductPresentation::select('product_id', 'presentation')
        ->where('parent_product_id', $this->id)
        ->whereHas('product', fn ($query) => $query->active($this->catalogCountry['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar presentación por defecto
        if (!empty($this->presentations)) { $this->selectedPresentation = $this->id; }
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
        //Obtener información de las medidas del producto
        $this->measurements = ProductMeasurement::select('product_id', 'measurement')
        ->where('parent_product_id', $this->id)
        ->whereHas('product', fn ($query) => $query->active($this->catalogCountry['id']))
        ->orderBy('product_id', 'ASC')
        ->get()
        ->toArray();

        //Marcar medida por defecto
        if (!empty($this->measurements)) { $this->selectedMeasurement = $this->id; }
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
        if ($this->available == 0 && $available == 0) {
            //Emitir evento para mostrar mostrar los productos no disponibles
            return $this->dispatch('product.show.modal.available-message.initialize', skuProduct: $this->product['sku'], nameProduct: $this->product['name'], availableUntilProduct: $this->availableUntil, componentNotAvailablesProduct: $this->componentNotAvailables);
        }

        //Validar información
        $this->validate([
            'quantity' => 'required|integer|min:1|max:99',
            'selectedColor' => 'nullable|integer|exists:product_colors,product_id',
            'selectedPresentation' => 'nullable|integer|exists:product_presentations,product_id',
            'selectedMeasurement' => 'nullable|integer|exists:product_measurements,product_id',
        ]);

        //Guardar producto en el carrito de compras
        $sessionController->setCart($this->id, $this->quantity);

        //Emitir evento para actualizar el carrito de compras del menú
        $this->dispatch('general.header.content.cart.products.getProducts');

        //Emitir evento para mostrar el carrito de compras
        $this->dispatch('showCart');

        //Emitir evento para mostrar el mensaje
        $this->dispatch('showToast', message: 'Producto <span class="fw-bold"><u>agregado</u></span> a tu carrito de compras.', color: 'success');
    }

    public function getTechnologies() {
        //Obtener ID del producto principal o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->id;

        //Obtener información de las tecnologías del producto
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
        //Obtener ID del producto principal o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->id;

        //Obtener información de las características del producto
        $this->features = ProductFeature::with([ 'catalogProductFeature' ])
        ->whereHas('catalogProductFeature', fn ($query) => $query->status())
        ->where('product_id', $productId)
        ->get()
        ->toArray();
    }

    public function getAttachments() {
        //Obtener ID del producto principal o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->id;

        //Obtener información de los archivos adjuntos del producto
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
        //Obtener ID del producto principal o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->id;

        //Obtener información de los videos del producto
        $this->videos = ProductVideo::select('url')
        ->where('product_id', $productId)
        ->get()
        ->toArray();
    }

    public function getReplacements() {
        //Obtener ID del producto principal o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->id;

        //Obtener información de los repuestos del producto
        $this->replacements = ProductReplacement::with([ 'product', 'product.catalogProductBrand' ])
        ->whereHas('product', fn ($query) => $query->active($this->catalogCountry['id']))
        ->where('parent_product_id', $productId)
        ->get()
        ->map(function ($product) {
            return [
                'slug' => $product->product->slug,
                'sku' => $product->product->sku,
                'name' => $product->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $product->product->image,
                'price' => formatPriceWithCurrency($product->product->suggested_price + $product->product->vat_suggested_price, $this->catalogCountry),
                'rating' => $product->product->rating_total,
                'brandSlug' => $product->product->catalogProductBrand->slug
            ];
        })
        ->toArray();
    }

    public function getParts() {
        //Obtener ID del producto principal o del producto padre
        $productId = $this->product['parent_product_id'] != null ? $this->parentProduct['id'] : $this->id;

        //Obtener información de las partes del producto
        $this->parts = ProductPart::with([ 'product', 'product.catalogProductBrand' ])
        ->whereHas('product', fn ($query) => $query->active($this->catalogCountry['id']))
        ->where('parent_product_id', $productId)
        ->get()
        ->map(function ($product) {
            return [
                'slug' => $product->product->slug,
                'sku' => $product->product->sku,
                'name' => $product->product->name,
                'image' => env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $product->product->image,
                'price' => formatPriceWithCurrency($product->product->suggested_price + $product->product->vat_suggested_price, $this->catalogCountry),
                'rating' => $product->product->rating_total,
                'brandSlug' => $product->product->catalogProductBrand->slug
            ];
        })
        ->toArray();
    }
}

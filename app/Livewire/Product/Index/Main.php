<?php

namespace App\Livewire\Product\Index;

use App\Models\SessionController;
use App\Models\Product;
use App\Models\Search;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Locked;

class Main extends Component
{
    Use WithPagination;

    #[Locked]
    public $search;

    public function render(SessionController $sessionController)
    {
        //Obtener información del país en sesión
        $catalogCountry = $sessionController->getCatalogCountry()->toArray();

        if ($this->search) {
            //Validar si la busqueda ya existe
            $search = Search::where('query', $this->search)->where('status', 2)->first();

            if ($search && $search->normalized_query != null) {
                //Obtener busqueda normalizada
                $this->search = $search->normalized_query;
            }
        }

        //Obtener productos
        $products = Product::basicData()
        ->with([ 'catalogProductBrand', 'productColors', 'productPresentations' ])
        ->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('sku', 'like', '%' . $this->search . '%')
            ->orWhereHas('productTags', fn ($query) => $query->where('tag', 'like', '%' . $this->search . '%'));
        })
        ->active($catalogCountry['id'])
        ->get()->map(function ($product) use ($catalogCountry) {
            $product->name .= ' ';
            $product->image = env('STORAGE_PRODUCT_IMAGE_THUMBNAIL_PATH') . $product->image;
            $product->price = formatPriceWithCurrency($product->suggested_price + $product->vat_suggested_price, $catalogCountry);
            $product->short_description = str_replace("<p>", '<p class="mb-2">', $product->short_description);
            return $product;
        })->unique(function ($product) {
            if ($product->productColors->count() > 0) { $product->productColors->each(function($color) use (&$product) { $product->name = str_replace($color->color, '', $product->name); }); }
            if ($product->productPresentations->count() > 0) { $product->productPresentations->each(function($presentation) use (&$product) { $product->name = str_replace(' ' . $presentation->presentation . ' ', ' ', $product->name); }); }
            if ($product->productMeasurements->count() > 0) { $product->productMeasurements->each(function($measurement) use (&$product) { $product->name = str_replace(' ' . $measurement->measurement . ' ', ' ', $product->name); }); }
            return $product->name;
        });

        //Mostrar vista
        return view('livewire.product.index.main', [ 'products' => customPaginate($products, 5) ]);
    }

    public function mount() {
        //Emitir evento para actualizar el buscador
        $this->dispatch('general.header.content.main.initialize', search: $this->search);
    }
}

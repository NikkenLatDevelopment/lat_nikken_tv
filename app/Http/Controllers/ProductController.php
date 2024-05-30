<?php

namespace App\Http\Controllers;

use App\Models\SessionController;
use App\Models\Search;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(string $search = '') {
        if ($search) {
            //Validar información
            $validator = Validator::make(
                [ 'search' => $search ],
                [ 'search' => 'required|string|max:255' ]
            );

            if (!$validator->fails()) {
                //Guardar búsqueda
                Search::firstOrCreate([ 'query' => $search ]);
            } else {
                //Limpiar búsqueda
                $search = '';
            }
        }

        //Mostrar vista
        return view('product.index', [ 'search' => $search ]);
    }

    public function show(string $catalogProductBrandSlug, string $productSlug, SessionController $sessionController) {
        //Validar información
        $validator = Validator::make(
            [
                'catalogProductBrandSlug' => $catalogProductBrandSlug,
                'productSlug' => $productSlug
            ],
            [
                'catalogProductBrandSlug' => 'required|string|max:255|exists:catalog_product_brands,slug',
                'productSlug' => 'required|string|max:255|exists:products,slug'
            ]
        );

        if ($validator->fails()) {
            //Redireccionar
            return redirect()->route('category.show', $catalogProductBrandSlug);
        }

        //Obtener ID del país en sesión o cookie
        $catalogCountryId = $sessionController->getCatalogCountryId();

        //Obtener información del producto
        $product = Product::basicData()
        ->with([
            'catalogProductBrand',
            'productComponents.product' => fn ($query) => $query->availabilityData(),
        ])
        ->where('slug', $productSlug)
        ->active($catalogCountryId, $catalogProductBrandSlug)
        ->first();

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $catalogProductBrandSlug);
        }

        //Obtener disponibilidad y componentes del producto
        $productAvailable = $product->getAvailability($product->productComponents->toArray());

        //Convertir información del producto a array
        $product = $product->toArray();

        //Agregar disponibilidad y componentes a la información del producto
        $product['availability'] = $productAvailable;

        //Mostrar vista
        return view('product.show', [ 'product' => $product ]);
    }
}

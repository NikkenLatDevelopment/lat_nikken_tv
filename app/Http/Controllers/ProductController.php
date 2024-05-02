<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SessionController;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $catalogProductBrandSlug, string $productSlug, SessionController $sessionController) {
        //Validar información
        $validator = Validator::make(
            [
                'catalogProductBrandSlug' => $catalogProductBrandSlug,
                'productSlug' => $productSlug
            ], [
                'catalogProductBrandSlug' => 'required|string|max:255|exists:catalog_product_brands,slug',
                'productSlug' => 'required|string|max:255|exists:products,slug'
            ]
        );

        if ($validator->fails()) {
            //Redireccionar
            return redirect()->route('category.show', $catalogProductBrandSlug);
        }

        //Obtener información del país
        $catalogCountry = $sessionController->getCatalogCountry()->toArray();

        //Obtener información del producto
        $product = Product::basicData()
        ->with([
            'catalogProductBrand',
            'productComponents.product' => fn ($query) => $query->availabilityData(),
        ])
        ->where('slug', $productSlug)
        ->active($catalogCountry['id'], $catalogProductBrandSlug)
        ->first();

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $catalogProductBrandSlug);
        }

        //Mostrar vista
        return view('product.show', [
            'product' => $product,
            'productAvailability' => $product->getAvailability($product->productComponents->toArray())
        ]);
    }
}

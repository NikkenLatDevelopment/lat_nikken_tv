<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show(string $brandSlug, string $productSlug, SessionController $sessionController) {
        //Validar información
        $validator = Validator::make(
            [
                'brandSlug' => $brandSlug,
                'productSlug' => $productSlug
            ], [
                'brandSlug' => 'required|string|max:40|exists:catalog_product_brands,slug',
                'productSlug' => 'required|string|max:100|exists:products,slug'
            ]
        );

        if ($validator->fails()) {
            //Redireccionar
            return redirect()->route('category.show', $brandSlug);
        }

        //Obtener información del país
        $country = $sessionController->getCountry()->toArray();

        //Obtener información del producto
        $product = Product::basicData()
        ->with([
            'catalogProductBrand',
            'productComponents.product' => fn ($query) => $query->availabilityData(),
        ])
        ->where('slug', $productSlug)
        ->active($country['id'], $brandSlug)
        ->first();

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $brandSlug);
        }

        //Mostrar vista
        return view('product.show', [
            'product' => $product,
            'availability' => $product->getAvailability($product->productComponents->toArray())
        ]);
    }
}

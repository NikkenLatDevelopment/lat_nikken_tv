<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected SessionController $sessionController;

    public function __construct(SessionController $sessionController) {
        //Iniciar sesión
        $this->sessionController = $sessionController;
    }

    public function show(string $brandSlug, string $productSlug) {
        //Validar información
        $validator = Validator::make(
            [
                'brandSlug' => $brandSlug,
                'productSlug' => $productSlug
            ], [
                'brandSlug' => 'required|string|exists:catalog_product_brands,slug',
                'productSlug' => 'required|string|exists:products,slug'
            ]
        );

        if ($validator->fails()) {
            //Redireccionar
            return redirect()->route('category.show', $brandSlug);
        }

        //Obtener información del país
        $country = $this->sessionController->getCountry()->toArray();

        //Obtener información del producto
        $product = Product::basicData()
        ->with([ 'catalogProductBrand', 'productComponents.product' ])
        ->where('slug', $productSlug)
        ->active($country['id'], $brandSlug)
        ->first();

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $brandSlug);
        }

        //Mostrar vista
        return view('product.show', [ 'product' => $product, 'availability' => $product->getAvailability($product->productComponents->toArray()) ]);
    }
}

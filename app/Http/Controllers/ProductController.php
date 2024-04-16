<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SessionController;

class ProductController extends Controller
{
    protected SessionController $sessionController;

    public function __construct(SessionController $sessionController) {
        //Iniciar sesión
        $this->sessionController = $sessionController;
    }

    public function show(string $brandSlug, string $productSlug) {
        //Obtener información del país
        $country = $this->sessionController->getCountry()->toArray();

        //Obtener información del producto
        $product = Product::with([ 'catalogProductBrand' ])
        ->where('slug', $productSlug)
        ->active($country['id'], $brandSlug)
        ->first();

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $brandSlug);
        }

        //Mostrar vista
        return view('product.show', [ 'product' => $product ]);
    }
}

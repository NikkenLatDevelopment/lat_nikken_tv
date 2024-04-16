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
        //Obtener ID del país por sesión o cookie
        $countryId = $this->sessionController->getCountryId();

        //Obtener información del producto
        $product = Product::where('slug', $productSlug)
        ->active($countryId, $brandSlug)
        ->first();

        if (!$product) {
            //Redireccionar
            return redirect()->route('category.show', $brandSlug);
        }

        //Mostrar vista
        return view('product.show', [ 'product' => $product ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionController;

class CheckoutController extends Controller
{
    public function index(SessionController $sessionController) {
        if (!auth()->check()) {
            //Redireccionar
            return redirect()->route('login');
        }

        //Obtener productos del carrito de compras
        $products = $sessionController->getCart();

        if (empty($products)) {
            //Redireccionar
            return redirect()->route('home');
        }

        //Mostrar vista
        return view('checkout.index');
    }
}

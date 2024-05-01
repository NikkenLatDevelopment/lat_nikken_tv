<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionController;

class CheckoutController extends Controller
{
    protected SessionController $sessionController;

    public function __construct(SessionController $sessionController) {
        //Iniciar sesión
        $this->sessionController = $sessionController;
    }

    public function index() {
        if (!auth()->check()) {
            //Redireccionar
            return redirect()->route('login');
        }

        //Obtener productos del carrito de compras
        $products = $this->sessionController->getCart();

        if (empty($products)) {
            //Redireccionar
            return redirect()->route('home');
        }

        //Mostrar vista
        return view('checkout.index');
    }
}

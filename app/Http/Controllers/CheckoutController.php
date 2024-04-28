<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {
        if (!auth()->check()) {
            //Redireccionar
            return redirect()->route('login');
        }

        //Mostrar vista
        return view('checkout.index');
    }
}

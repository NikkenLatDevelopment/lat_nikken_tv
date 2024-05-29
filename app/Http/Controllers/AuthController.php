<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        //Validar sesión
        if (auth()->check()) { return redirect()->route('checkout.index'); }

        //Mostrar vista
        return view('auth.index');
    }

    public function destroy() {
        //Cerrar sesión
        auth()->logout();

        //Redireccionar
        return redirect()->route('login');
    }
}

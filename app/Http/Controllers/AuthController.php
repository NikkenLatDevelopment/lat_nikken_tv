<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function destroy() {
        //Cerrar sesión
        auth()->logout();

        //Redireccionar
        return redirect()->route('login');
    }
}

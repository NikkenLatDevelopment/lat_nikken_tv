<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function destroy() {
        //Cerrar sesión
        Auth::logout();

        //Redireccionar
        return redirect()->route('login');
    }
}

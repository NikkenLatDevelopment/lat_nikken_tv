<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemporalController extends Controller
{
    public function index() {
        //Iniciar sesión //! Eliminar
        Auth::loginUsingId(1);
        //Iniciar sesión //! Eliminar
    }

    public function logout() {
        //Cerrar sesión //! Eliminar
        Auth::logout();
        //Cerrar sesión //! Eliminar
    }
}

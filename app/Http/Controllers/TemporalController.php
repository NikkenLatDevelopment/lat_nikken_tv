<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemporalController extends Controller
{
    public function index() {
        //Iniciar sesión //! Eliminar
        auth()->loginUsingId(1);
        //Iniciar sesión //! Eliminar
    }

    public function logout() {
        //Cerrar sesión //! Eliminar
        auth()->logout();
        //Cerrar sesión //! Eliminar
    }
}

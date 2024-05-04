<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TemporalController extends Controller
{
    public function index() {
        //Iniciar sesión //! Eliminar
        auth()->loginUsingId(1);

        //Unificar carrito de compras //TODO: !!!! Pendiente
    }

    public function decode(string $urlDecode) {
        //Decodificar URL //! Eliminar
        dd(Crypt::decryptString($urlDecode));
    }
}

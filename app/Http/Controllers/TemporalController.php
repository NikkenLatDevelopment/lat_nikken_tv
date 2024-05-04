<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TemporalController extends Controller
{
    public function decode(string $urlDecode) {
        //Decodificar URL //! Eliminar
        dd(Crypt::decryptString($urlDecode));
    }
}

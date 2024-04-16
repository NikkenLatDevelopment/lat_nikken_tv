<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemporalController extends Controller
{
    public function index() {
        //Iniciar sesión
        Auth::loginUsingId(1);
        //Iniciar sesión
    }

    public function logout() {
        //Cerrar sesión
        Auth::logout();
        //Cerrar sesión
    }
}

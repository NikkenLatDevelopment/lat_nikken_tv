<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionController;
use App\Models\CatalogCountry;

class CountryController extends Controller
{
    public function index() {
        //Mostrar vista
        return view('country.index');
    }

    public function update(int $catalogCountryId, SessionController $sessionController) {
        //Validar información
        if ($catalogCountryId <= 0) { return redirect()->route('country.index'); }

        //Obtener información del país
        $catalogCountry = CatalogCountry::sessionData()
        ->closed()
        ->status()
        ->find($catalogCountryId);

        if ($catalogCountry) {
            //Guardar información del país en sesión y cookie
            $sessionController->setCatalogCountry($catalogCountry->toArray());

            //Redireccionar
            return redirect()->back();
        }

        //Redireccionar
        return redirect()->route('country.index');
    }
}

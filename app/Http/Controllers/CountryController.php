<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogCountry;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index() {
        //Mostrar vista
        return view('country.index');
    }

    public function update(int $catalogCountryId, SessionController $sessionController) {
        //Validar información
        if ($catalogCountryId <= 0) { return redirect()->route('country.index'); }

        //Obtener país
        $catalogCountry = CatalogCountry::sessionData()
        ->closed()
        ->status()
        ->find($catalogCountryId);

        if ($catalogCountry) {
            //Guardar país en sesión
            $sessionController->setCountry($catalogCountry->toArray());

            //Redireccionar
            return redirect()->back();
        }

        //Redireccionar
        return redirect()->route('country.index');
    }
}

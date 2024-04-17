<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogCountry;
use App\Models\SessionController;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    protected SessionController $sessionController;

    public function __construct(SessionController $sessionController) {
        //Iniciar sesión
        $this->sessionController = $sessionController;
    }

    public function index() {
        //Mostrar vista
        return view('country.index');
    }

    public function update(int $countryId, SessionController $sessionController) {
        //Validar información
        $validator = Validator::make(
            [ 'countryId' => $countryId ],
            [ 'countryId' => 'required|integer|exists:catalog_countries,id' ]
        );

        if ($validator->fails()) {
            //Redireccionar
            return redirect()->route('country.index');
        }

        //Buscar país
        $country = CatalogCountry::sessionData()
        ->closed()
        ->status()
        ->find($countryId);

        if ($country) {
            //Guardar país en sesión
            $sessionController->setCountry($country->toArray());

            //Redireccionar
            return redirect()->route('home');
        }

        //Redireccionar
        return redirect()->route('country.index');
    }
}

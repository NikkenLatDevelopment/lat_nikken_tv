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

    public function update(int $catalog_country_id, SessionController $sessionController) {
        //Validar información
        $validator = Validator::make(
            [ 'catalog_country_id' => $catalog_country_id ],
            [ 'catalog_country_id' => 'required|integer|exists:catalog_countries,id' ]
        );

        if ($validator->fails()) {
            //Redireccionar
            return redirect()->route('country.index');
        }

        //Buscar país
        $catalogCountry = CatalogCountry::sessionData()
        ->closed()
        ->status()
        ->find($catalog_country_id);

        if ($catalogCountry) {
            //Guardar país en sesión
            $sessionController->setCountry($catalogCountry->toArray());

            //Redireccionar
            return redirect()->route('home');
        }

        //Redireccionar
        return redirect()->route('country.index');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SessionController;
use App\Models\CatalogCountry;

class DetermineUserLocation
{
    protected SessionController $sessionController;

    public function __construct(SessionController $sessionController) {
        //Iniciar sesión
        $this->sessionController = $sessionController;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Obtener el ID del país por sesión o cookie
        $catalogCountryId = $this->sessionController->getCatalogCountryId();

        if (!$catalogCountryId) {
            //Obtener localización
            $location = Location::get();

            if (!isset($location->countryCode)) {
                //Redireccionar
                return redirect()->route('country.index');
            }

            //Obtener información del país
            $catalogCountry = CatalogCountry::sessionData()
            ->where('code', $location->countryCode)
            ->closed()
            ->status()
            ->first();

            if (!$catalogCountry) {
                //Redireccionar
                return redirect()->route('country.index');
            }
        } else {
            //Obtener información del país
            $catalogCountry = CatalogCountry::sessionData()
            ->closed()
            ->status()
            ->find($catalogCountryId);

            if (!$catalogCountry) {
                //Redireccionar
                return redirect()->route('country.index');
            }
        }

        //Guardar país en sesión y cookie
        $this->sessionController->setCatalogCountry($catalogCountry->toArray());

        //Retornar
        return $next($request);
    }
}

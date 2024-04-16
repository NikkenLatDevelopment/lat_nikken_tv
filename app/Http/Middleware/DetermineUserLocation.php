<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CatalogCountry;
use App\Models\SessionController;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

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
        //Obtener ID del país por sesión o cookie
        $countryId = $this->sessionController->getCountryId();

        if (!$countryId) {
            //Obtener localización
            $location = Location::get();

            if (!isset($location->countryCode)) {
                //Redireccionar
                return redirect()->route('country.index');
            }

            //Buscar país
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
            //Buscar país
            $catalogCountry = CatalogCountry::sessionData()
            ->closed()
            ->status()
            ->find($countryId);

            if (!$catalogCountry) {
                //Redireccionar
                return redirect()->route('country.index');
            }
        }

        //Guardar país en sesión
        $this->sessionController->setCountry($catalogCountry->toArray());

        return $next($request);
    }
}

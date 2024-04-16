<?php

namespace App\Models;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Cookie;

class SessionController
{
    protected $session;

    public function __construct(SessionManager $session) {
        //Iniciar sesión
        $this->session = $session;
    }

    public function setCountry(array $catalogCountry): void {
        //Generar objeto
        $country = SessionControllerCountry::toObject($catalogCountry);

        //Guardar sesión
        $this->session->put("country", $country->toArray());

        //Guardar cookie
        Cookie::queue('country_id', $country->id);
    }

    public function getCountry(): ?object {
        //Obtener información
        $country = $this->session->get('country');

        //Generar objeto
        return $country ? SessionControllerCountry::toObject($country) : null;
    }

    public function getCountryId(): ?int {
        //Obtener ID del país por sesión
        $countryId = $this->session->get('country.id');

        if (empty($countryId)) {
            //Obtener ID del país por cookie
            $countryId = Cookie::get('country_id');
        }

        return $countryId;
    }
}

class SessionControllerCountry {
    public function __construct(public int $id, public string $code, public string $name, public float $vat, public string $currency_symbol, public int $currency_decimal) {}

    public static function toObject(array $country): object {
        //Generar objeto
        return new self(id: $country['id'], code: $country['code'], name: $country['name'], vat: $country['vat'], currency_symbol: $country['currency_symbol'], currency_decimal: $country['currency_decimal']);
    }

    public function toArray(): array {
        //Generar array
        return [ 'id' => $this->id, 'code' => $this->code, 'name' => $this->name, 'vat' => $this->vat, 'currency_symbol' => $this->currency_symbol, 'currency_decimal' => $this->currency_decimal ];
    }
}

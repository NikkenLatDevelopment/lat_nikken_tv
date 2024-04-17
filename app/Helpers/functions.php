<?php

use Illuminate\Support\Carbon;

function formatPriceWithCurrency(float $price, array $country) {
    //Formatear precio con símbolo de moneda
    return $country['currency_symbol'] . number_format($price, $country['currency_decimal']);
}

function formatDateInSpanishLocale(string $date) {
    //Formatear fecha a texto en español
    return Carbon::parse($date)->locale('es_ES')->isoFormat('DD [de] MMMM [del] YYYY');
}

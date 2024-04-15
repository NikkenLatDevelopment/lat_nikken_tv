<?php

use Illuminate\Support\Carbon;

function formatDateInSpanishLocale(string $date) {
    //Formatear fecha a texto
    return Carbon::parse($date)->locale('es_ES')->isoFormat('DD [de] MMMM [del] YYYY');
}

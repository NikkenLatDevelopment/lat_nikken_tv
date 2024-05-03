<?php

use Illuminate\Support\Carbon;
use App\Models\Product;

function formatPrice(float $price, int $decimals): float {
    //Formatear precio con decimales
    return number_format($price, $decimals);
}

function formatPriceWithCurrency(float $price, array $catalogCountry): string {
    //Formatear precio con símbolo de moneda y decimales
    return $catalogCountry['currency_symbol'] . number_format($price, $catalogCountry['currency_decimal']);
}

function formatDateInSpanishLocale(string $date): string {
    //Formatear fecha a texto en español en formato DD de MMMM del YYYY
    return Carbon::parse($date)->locale('es_ES')->isoFormat('DD [de] MMMM [del] YYYY');
}

function formatDateToDDMMMYYYY(string $date): string {
    //Formatear fecha en formato DD MMM YYYY
    return Carbon::parse($date)->isoFormat('DD MMM YYYY');
}

function formatCartProduct(Product $product, int $quantity, array $catalogCountry): array {
    //Formatear información del producto para el carrito de compras
    return [
        'id' => $product->id,
        'slug' => $product->slug,
        'sku' => $product->sku,
        'name' => $product->name,
        'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $product->image,
        'price' => $product->suggested_price + $product->vat_suggested_price,
        'priceText' => formatPriceWithCurrency($product->suggested_price + $product->vat_suggested_price, $catalogCountry),
        'quantity' => $quantity,
        'available' => array_values($product->getAvailability($product->productComponents->toArray()))[0],
        'rating' => $product->rating_total,
        'brandSlug' => $product->catalogProductBrand->slug,
        'retail' => $product->retail * $quantity,
        'vatRetail' => $product->vat_retail * $quantity,
        'subtotal' => $product->suggested_price * $quantity,
        'vat' => $product->vat_suggested_price * $quantity,
        'total' => ($product->suggested_price + $product->vat_suggested_price) * $quantity,
        'totalText' => formatPriceWithCurrency(($product->suggested_price + $product->vat_suggested_price) * $quantity, $catalogCountry),
        'points' => $product->points * $quantity,
        'vc' => $product->vc * $quantity,
    ];
}

function formatAddressPhone(string $cellphone, ?string $phone): string {
    //Formatear información de contacto
    return $phone ? "$cellphone, $phone" : $cellphone;
}

function formatAddressInfo(string $address, string $state, string $municipality, ?string $complementAddress, ?string $referenceAddress, ?string $colony, ?string $postalCode): string {
    //Crear array con todos los componentes de la dirección
    $parts = [ $address, $complementAddress, $referenceAddress, $state, $municipality, $colony, $postalCode ];

    //Filtrar elementos vacíos y unirlos con coma
    $result = implode(', ', array_filter($parts, fn ($part) => !empty($part)));

    //Retornar dirección
    return $result;
}

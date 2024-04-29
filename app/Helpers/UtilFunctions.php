<?php

use App\Models\Product;
use Illuminate\Support\Carbon;

function formatPrice(float $price, int $decimals) {
    //Formatear precio
    return number_format($price, $decimals);
}

function formatPriceWithCurrency(float $price, array $country) {
    //Formatear precio con símbolo de moneda
    return $country['currency_symbol'] . number_format($price, $country['currency_decimal']);
}

function formatDateInSpanishLocale(string $date) {
    //Formatear fecha a texto en español
    return Carbon::parse($date)->locale('es_ES')->isoFormat('DD [de] MMMM [del] YYYY');
}

function formatDateToDDMMMYYYY(string $date) {
    //Formatear fecha
    return Carbon::parse($date)->isoFormat('DD MMM YYYY');
}

function formatCartProduct(Product $product, int $quantity, array $country): array {
    //Formatear información del producto
    return [
        'id' => $product->id,
        'slug' => $product->slug,
        'sku' => $product->sku,
        'name' => $product->name,
        'image' => env('STORAGE_PRODUCT_IMAGE_MAIN_PATH') . $product->image,
        'price' => $product->suggested_price + $product->vat_suggested_price,
        'priceText' => formatPriceWithCurrency($product->suggested_price + $product->vat_suggested_price, $country),
        'quantity' => $quantity,
        'available' => array_values($product->getAvailability($product->productComponents->toArray()))[0],
        'rating' => $product->rating_total,
        'brandSlug' => $product->catalogProductBrand->slug,
        'retail' => $product->retail * $quantity,
        'vatRetail' => $product->vat_retail * $quantity,
        'subtotal' => $product->suggested_price * $quantity,
        'vat' => $product->vat_suggested_price * $quantity,
        'total' => ($product->suggested_price + $product->vat_suggested_price) * $quantity,
        'totalText' => formatPriceWithCurrency(($product->suggested_price + $product->vat_suggested_price) * $quantity, $country),
        'points' => $product->points * $quantity,
        'vc' => $product->vc * $quantity,
    ];
}

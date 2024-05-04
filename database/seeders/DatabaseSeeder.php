<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Catálogo de países
        \App\Models\CatalogCountry::factory()->create([ 'id' => 1, 'code' => 'CO', 'name' => 'Colombia', 'abbrev' => 'COL', 'vat' => 1.19, 'currency_code' => 'COP', 'currency_symbol' => '$', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 2, 'code' => 'MX', 'name' => 'México', 'abbrev' => 'MEX', 'vat' => 1.19, 'currency_code' => 'MEX', 'currency_symbol' => '$', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 3, 'code' => 'PE', 'name' => 'Perú', 'abbrev' => 'PER', 'vat' => 1.19, 'currency_code' => 'PEN', 'currency_symbol' => 'S/', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 4, 'code' => 'EC', 'name' => 'Ecuador', 'abbrev' => 'ECU', 'vat' => 1.19, 'currency_code' => 'USD', 'currency_symbol' => '$', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 5, 'code' => 'PA', 'name' => 'Panamá', 'abbrev' => 'PAN', 'vat' => 1.19, 'currency_code' => 'USD', 'currency_symbol' => '$', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 6, 'code' => 'GT', 'name' => 'Guatemala', 'abbrev' => 'GTM', 'vat' => 1.19, 'currency_code' => 'GTQ', 'currency_symbol' => 'Q', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 7, 'code' => 'SV', 'name' => 'El Salvador', 'abbrev' => 'SLV', 'vat' => 1.19, 'currency_code' => 'USD', 'currency_symbol' => '$', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 8, 'code' => 'CR', 'name' => 'Costa Rica', 'abbrev' => 'CRI', 'vat' => 1.19, 'currency_code' => 'CRC', 'currency_symbol' => '₡', 'currency_decimal' => 0 ]);
        \App\Models\CatalogCountry::factory()->create([ 'id' => 10, 'code' => 'CL', 'name' => 'Chile', 'abbrev' => 'CHL', 'vat' => 1.19, 'currency_code' => 'CLP', 'currency_symbol' => '$', 'currency_decimal' => 0 ]);
        //Catálogo de países

        //Catálogo tipo de usuario
        \App\Models\CatalogUserType::factory()->create([ 'id' => 1, 'name' => 'Invitado' ]);
        \App\Models\CatalogUserType::factory()->create([ 'id' => 2, 'name' => 'Cliente' ]);
        \App\Models\CatalogUserType::factory()->create([ 'id' => 3, 'name' => 'Socio Independiente' ]);
        //Catálogo tipo de usuario

        //Usuario
        \App\Models\User::factory(10)->create();
        //Usuario

        //Marcas
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'sin-marca', 'name' => 'Sin Marca', 'alias' => 'Sin Marca' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'kenko-sleep', 'name' => 'KENKO SLEEP', 'alias' => 'Descanso' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'pimag', 'name' => 'PIMAG', 'alias' => 'Agua' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'kenkoair', 'name' => 'KENKOAIR', 'alias' => 'Aire' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'kenkolight', 'name' => 'KENKOLIGHT', 'alias' => 'Luz' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'kenzen', 'name' => 'KENZEN', 'alias' => 'Nutrición' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'kenko-balance', 'name' => 'KENKO BALANCE', 'alias' => 'Accesorios' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'kenkotherm', 'name' => 'KENKOTHERM', 'alias' => 'Soporte' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'kenko-fashion', 'name' => 'KENKO FASHION', 'alias' => 'Joyería' ]);
        \App\Models\CatalogProductBrand::factory()->create([ 'slug' => 'true-elements', 'name' => 'TRUE ELEMENTS', 'alias' => 'Cuidado de la Piel' ]);
        //Marcas

        //Productos
        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 4,
            'sku' => 1441,
            'slug' => 'kenkoair-purifier',
            'name' => 'KenkoAir Purifier',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'maintenance' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'differentiators' => 'Filtración H13.|Filtración de sedimentos como polvo, caspa de mascotas, entre otros.|Neutraliza olores.|Filtra partículas pequeñas con el 99.9% de efectividad.|Sistema de iones que reproduce un aire natural.|Tecnología libre de ozono.|Bajo consumo eléctrico.',
            'image' => '1441_1.png',
            'video' => 'https://www.youtube.com/watch?v=UjZdezbTAg0',
            'wholesale_price' => 1848739.38,
            'vat_wholesale_price' => 351260.62,
            'suggested_price' => 2310924.25,
            'vat_suggested_price' => 439075.75,
            'vat_applies' => 1,
            'stock' => 10,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 462184.88,
            'vat_retail' => 87815.13,
            'warranty' => '3 años en el motor y un año en las partes de garantía',
            'rating_total' => 4.3,
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 7,
            'sku' => 1454,
            'slug' => 'kenko-balance-powerchip-rojo',
            'name' => 'Kenko Balance Powerchip Rojo',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'maintenance' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'differentiators' => 'Filtración H13.|Filtración de sedimentos como polvo, caspa de mascotas, entre otros.|Neutraliza olores.|Filtra partículas pequeñas con el 99.9% de efectividad.|Sistema de iones que reproduce un aire natural.|Tecnología libre de ozono.|Bajo consumo eléctrico.',
            'image' => '1454_1.png',
            'video' => 'https://www.youtube.com/watch?v=UjZdezbTAg0',
            'wholesale_price' => 73000,
            'vat_wholesale_price' => 73000,
            'suggested_price' => 73000,
            'vat_suggested_price' => 73000,
            'vat_applies' => 1,
            'stock' => 0,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 7,
            'sku' => 1453,
            'slug' => 'kenko-balance-powerchip-verde',
            'name' => 'Kenko Balance Powerchip Verde',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'differentiators' => 'Filtración H13.|Filtración de sedimentos como polvo, caspa de mascotas, entre otros.|Neutraliza olores.|Filtra partículas pequeñas con el 99.9% de efectividad.|Sistema de iones que reproduce un aire natural.|Tecnología libre de ozono.|Bajo consumo eléctrico.',
            'image' => '1453_1.png',
            'wholesale_price' => 73000,
            'vat_wholesale_price' => 73000,
            'suggested_price' => 73000,
            'vat_suggested_price' => 73000,
            'vat_applies' => 1,
            'stock' => 100,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 7,
            'sku' => 1450,
            'slug' => 'kenko-balance-powerchip-negro',
            'name' => 'Kenko Balance Powerchip Negro',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'image' => '1450_1.png',
            'video' => 'https://www.youtube.com/watch?v=UjZdezbTAg0',
            'wholesale_price' => 49075.63,
            'vat_wholesale_price' => 9324.37,
            'suggested_price' => 61344.54,
            'vat_suggested_price' => 11655.46,
            'vat_applies' => 1,
            'stock' => 100,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 12268.91,
            'vat_retail' => 2331.09 ,
            'warranty' => '3 años en el motor y un año en las partes de garantía',
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 7,
            'sku' => 1770,
            'slug' => 'kenko-balance-sport-medias-cortas-l',
            'name' => 'Kenko Balance Sport Medias Cortas L',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'differentiators' => 'Filtración H13.|Filtración de sedimentos como polvo, caspa de mascotas, entre otros.|Neutraliza olores.|Filtra partículas pequeñas con el 99.9% de efectividad.|Sistema de iones que reproduce un aire natural.|Tecnología libre de ozono.|Bajo consumo eléctrico.',
            'image' => '1770_1.png',
            'wholesale_price' => 52000,
            'vat_wholesale_price' => 52000,
            'suggested_price' => 52000,
            'vat_suggested_price' => 52000,
            'vat_applies' => 1,
            'stock' => 100,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 7,
            'sku' => 1769,
            'slug' => 'kenko-balance-sport-medias-cortas-m',
            'name' => 'Kenko Balance Sport Medias Cortas M',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'differentiators' => 'Filtración H13.|Filtración de sedimentos como polvo, caspa de mascotas, entre otros.|Neutraliza olores.|Filtra partículas pequeñas con el 99.9% de efectividad.|Sistema de iones que reproduce un aire natural.|Tecnología libre de ozono.|Bajo consumo eléctrico.',
            'image' => '1769_1.png',
            'wholesale_price' => 60000,
            'vat_wholesale_price' => 60000,
            'suggested_price' => 60000,
            'vat_suggested_price' => 60000,
            'vat_applies' => 1,
            'stock' => 100,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 7,
            'sku' => 1768,
            'slug' => 'kenko-balance-sport-medias-largas-l',
            'name' => 'Kenko Balance Sport Medias Largas L',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'differentiators' => 'Filtración H13.|Filtración de sedimentos como polvo, caspa de mascotas, entre otros.|Neutraliza olores.|Filtra partículas pequeñas con el 99.9% de efectividad.|Sistema de iones que reproduce un aire natural.|Tecnología libre de ozono.|Bajo consumo eléctrico.',
            'image' => '1768_1.png',
            'wholesale_price' => 65000,
            'vat_wholesale_price' => 65000,
            'suggested_price' => 65000,
            'vat_suggested_price' => 65000,
            'vat_applies' => 1,
            'stock' => 100,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 7,
            'sku' => 1767,
            'slug' => 'kenko-balance-sport-medias-largas-m',
            'name' => 'Kenko Balance Sport Medias Largas M',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'differentiators' => 'Filtración H13.|Filtración de sedimentos como polvo, caspa de mascotas, entre otros.|Neutraliza olores.|Filtra partículas pequeñas con el 99.9% de efectividad.|Sistema de iones que reproduce un aire natural.|Tecnología libre de ozono.|Bajo consumo eléctrico.',
            'image' => '1767_1.png',
            'wholesale_price' => 72000,
            'vat_wholesale_price' => 72000,
            'suggested_price' => 72000,
            'vat_suggested_price' => 72000,
            'vat_applies' => 1,
            'stock' => 100,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'is_visible' => 1
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 4,
            'sku' => '1441a',
            'slug' => 'kenkoair-purifier',
            'name' => 'KenkoAir Purifier',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'image' => '1441_1.png',
            'wholesale_price' => 2000000,
            'vat_wholesale_price' => 2000000,
            'suggested_price' => 2000000,
            'vat_suggested_price' => 2000000,
            'vat_applies' => 1,
            'stock' => 0,
            'stock_applies' => 0,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'rating_total' => 4.3,
            'is_visible' => 0
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 4,
            'sku' => '1441b',
            'slug' => 'kenkoair-purifier',
            'name' => 'KenkoAir Purifier',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'image' => '1441_1.png',
            'wholesale_price' => 2000000,
            'vat_wholesale_price' => 2000000,
            'suggested_price' => 2000000,
            'vat_suggested_price' => 2000000,
            'vat_applies' => 1,
            'stock' => 10,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'rating_total' => 4.3,
            'is_visible' => 0
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 4,
            'sku' => '1441c',
            'slug' => 'kenkoair-purifier',
            'name' => 'KenkoAir Purifier',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'image' => '1441_1.png',
            'wholesale_price' => 2000000,
            'vat_wholesale_price' => 2000000,
            'suggested_price' => 2000000,
            'vat_suggested_price' => 2000000,
            'vat_applies' => 1,
            'stock' => 0,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'rating_total' => 4.3,
            'is_visible' => 0
        ]);

        \App\Models\Product::factory()->create([
            'catalog_country_id' => 1,
            'catalog_product_brand_id' => 4,
            'sku' => '1441d',
            'slug' => 'kenkoair-purifier',
            'name' => 'KenkoAir Purifier',
            'short_description' => '<p>Non culpa exercitation quis sit adipisicing sunt dolore quis, Non culpa exercitation quis sit adipisicing sunt dolore quis.</p>',
            'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>',
            'image' => '1441_1.png',
            'wholesale_price' => 2000000,
            'vat_wholesale_price' => 2000000,
            'suggested_price' => 2000000,
            'vat_suggested_price' => 2000000,
            'vat_applies' => 1,
            'stock' => -59,
            'stock_applies' => 1,
            'points' => 100,
            'vc' => 10000,
            'retail' => 10000,
            'vat_retail' => 87815.13,
            'rating_total' => 4.3,
            'is_visible' => 0
        ]);
        //Productos

        //Imágenes de productos
        \App\Models\ProductImage::factory()->create([ 'product_id' => 1, 'image' => '1441_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 1, 'image' => '1441_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 1, 'image' => '1441_4.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 1, 'image' => '1441_1.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 2, 'image' => '1454_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 2, 'image' => '1454_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 3, 'image' => '1453_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 3, 'image' => '1453_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 4, 'image' => '1450_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 4, 'image' => '1450_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 5, 'image' => '1770_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 5, 'image' => '1770_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 5, 'image' => '1770_4.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 6, 'image' => '1769_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 6, 'image' => '1769_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 6, 'image' => '1769_4.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 7, 'image' => '1768_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 7, 'image' => '1768_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 7, 'image' => '1768_4.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 7, 'image' => '1768_5.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 8, 'image' => '1767_2.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 8, 'image' => '1767_3.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 8, 'image' => '1767_4.png' ]);
        \App\Models\ProductImage::factory()->create([ 'product_id' => 8, 'image' => '1767_5.png' ]);
        //Imágenes de productos

        //Colores del producto
        \App\Models\ProductColor::factory()->create([ 'product_id' => 2, 'parent_product_id' => 2, 'color' => 'Rojo' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 3, 'parent_product_id' => 2, 'color' => 'Verde' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 4, 'parent_product_id' => 2, 'color' => 'Negro' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 2, 'parent_product_id' => 3, 'color' => 'Rojo' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 3, 'parent_product_id' => 3, 'color' => 'Verde' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 4, 'parent_product_id' => 3, 'color' => 'Negro' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 2, 'parent_product_id' => 4, 'color' => 'Rojo' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 3, 'parent_product_id' => 4, 'color' => 'Verde' ]);
        \App\Models\ProductColor::factory()->create([ 'product_id' => 4, 'parent_product_id' => 4, 'color' => 'Negro' ]);
        //Colores del producto

        //Presentación del producto
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 5, 'parent_product_id' => 5, 'presentation' => 'Cortas' ]);
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 7, 'parent_product_id' => 5, 'presentation' => 'Largas' ]);
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 5, 'parent_product_id' => 7, 'presentation' => 'Cortas' ]);
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 7, 'parent_product_id' => 7, 'presentation' => 'Largas' ]);
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 6, 'parent_product_id' => 6, 'presentation' => 'Cortas' ]);
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 8, 'parent_product_id' => 6, 'presentation' => 'Largas' ]);
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 6, 'parent_product_id' => 8, 'presentation' => 'Cortas' ]);
        \App\Models\ProductPresentation::factory()->create([ 'product_id' => 8, 'parent_product_id' => 8, 'presentation' => 'Largas' ]);
        //Presentación del producto

        //Medidas del producto
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 5, 'parent_product_id' => 5, 'measurement' => 'L' ]);
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 6, 'parent_product_id' => 5, 'measurement' => 'M' ]);
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 6, 'parent_product_id' => 6, 'measurement' => 'M' ]);
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 5, 'parent_product_id' => 6, 'measurement' => 'L' ]);
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 7, 'parent_product_id' => 7, 'measurement' => 'L' ]);
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 8, 'parent_product_id' => 7, 'measurement' => 'M' ]);
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 8, 'parent_product_id' => 8, 'measurement' => 'M' ]);
        \App\Models\ProductMeasurement::factory()->create([ 'product_id' => 7, 'parent_product_id' => 8, 'measurement' => 'L' ]);
        //Medidas del producto

        //Componentes del producto
        \App\Models\ProductComponent::factory()->create([ 'product_id' => 9, 'parent_product_id' => 1 ]);
        \App\Models\ProductComponent::factory()->create([ 'product_id' => 10, 'parent_product_id' => 1 ]);
        \App\Models\ProductComponent::factory()->create([ 'product_id' => 11, 'parent_product_id' => 1 ]);
        \App\Models\ProductComponent::factory()->create([ 'product_id' => 12, 'parent_product_id' => 1 ]);
        //Componentes del producto

        //Tecnologías
        \App\Models\CatalogProductTechnology::factory()->create([ 'slug' => 'magnetismo', 'name' => 'Magnetismo', 'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>' ]);
        \App\Models\CatalogProductTechnology::factory()->create([ 'slug' => 'infrarojo-lejano', 'name' => 'Infrarojo Lejano', 'description' => '<p>Duis ad duis amet ad do excepteur. Laboris nisi veniam amet Lorem exercitation commodo magna nisi cillum reprehenderit labore ut. Ex laboris minim eu reprehenderit ex ad mollit. Dolor irure in nisi anim. Est do esse dolore sunt enim occaecat nulla nulla irure. Veniam labore nulla duis anim nostrud tempor sint Lorem exercitation sint incididunt.</p>' ]);
        //Tecnologías

        //Teconologías de productos
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 1, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 1, 'catalog_product_technology_id' => 2 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 2, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 2, 'catalog_product_technology_id' => 2 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 3, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 3, 'catalog_product_technology_id' => 2 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 4, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 4, 'catalog_product_technology_id' => 2 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 5, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 5, 'catalog_product_technology_id' => 2 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 6, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 6, 'catalog_product_technology_id' => 2 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 7, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 7, 'catalog_product_technology_id' => 2 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 8, 'catalog_product_technology_id' => 1 ]);
        \App\Models\ProductTechnology::factory()->create([ 'product_id' => 8, 'catalog_product_technology_id' => 2 ]);
        //Teconologías de productos

        //Características
        \App\Models\CatalogProductFeature::factory()->create([ 'name' => 'Altura' ]);
        \App\Models\CatalogProductFeature::factory()->create([ 'name' => 'Ancho' ]);
        \App\Models\CatalogProductFeature::factory()->create([ 'name' => 'Profundidad' ]);
        \App\Models\CatalogProductFeature::factory()->create([ 'name' => 'Peso' ]);
        \App\Models\CatalogProductFeature::factory()->create([ 'name' => 'Material' ]);
        //Características

        //Características de productos
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 1, 'catalog_product_feature_id' => 1, 'value' => '10 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 1, 'catalog_product_feature_id' => 2, 'value' => '20 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 1, 'catalog_product_feature_id' => 3, 'value' => '30 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 1, 'catalog_product_feature_id' => 4, 'value' => '40 kg' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 1, 'catalog_product_feature_id' => 5, 'value' => 'Plástico' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 2, 'catalog_product_feature_id' => 1, 'value' => '10 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 2, 'catalog_product_feature_id' => 2, 'value' => '20 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 2, 'catalog_product_feature_id' => 3, 'value' => '30 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 2, 'catalog_product_feature_id' => 4, 'value' => '40 kg' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 2, 'catalog_product_feature_id' => 5, 'value' => 'Plástico' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 3, 'catalog_product_feature_id' => 1, 'value' => '10 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 3, 'catalog_product_feature_id' => 2, 'value' => '20 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 3, 'catalog_product_feature_id' => 3, 'value' => '30 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 3, 'catalog_product_feature_id' => 4, 'value' => '40 kg' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 3, 'catalog_product_feature_id' => 5, 'value' => 'Plástico' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 4, 'catalog_product_feature_id' => 1, 'value' => '10 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 4, 'catalog_product_feature_id' => 2, 'value' => '20 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 4, 'catalog_product_feature_id' => 3, 'value' => '30 cm' ]);
        \App\Models\ProductFeature::factory()->create([ 'product_id' => 4, 'catalog_product_feature_id' => 4, 'value' => '40 kg' ]);
        //Características de productos

        //Adjuntos
        \App\Models\CatalogProductAttachment::factory()->create([ 'name' => 'Ficha Técnica' ]);
        \App\Models\CatalogProductAttachment::factory()->create([ 'name' => 'Manual de Uso' ]);
        \App\Models\CatalogProductAttachment::factory()->create([ 'name' => 'Manual de Mantenimiento' ]);
        \App\Models\CatalogProductAttachment::factory()->create([ 'name' => 'Infografía' ]);
        \App\Models\CatalogProductAttachment::factory()->create([ 'name' => 'Análisis de Laboratorio' ]);
        //Adjuntos

        //Adjuntos de productos
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 1, 'catalog_product_attachment_id' => 1, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 1, 'catalog_product_attachment_id' => 2, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 1, 'catalog_product_attachment_id' => 3, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 1, 'catalog_product_attachment_id' => 4, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 1, 'catalog_product_attachment_id' => 5, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 2, 'catalog_product_attachment_id' => 1, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 2, 'catalog_product_attachment_id' => 2, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 2, 'catalog_product_attachment_id' => 3, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 2, 'catalog_product_attachment_id' => 4, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 3, 'catalog_product_attachment_id' => 1, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 3, 'catalog_product_attachment_id' => 2, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 3, 'catalog_product_attachment_id' => 3, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 4, 'catalog_product_attachment_id' => 1, 'file' => 'file.pdf' ]);
        \App\Models\ProductAttachment::factory()->create([ 'product_id' => 4, 'catalog_product_attachment_id' => 2, 'file' => 'file.pdf' ]);
        //Adjuntos de productos

        //Videos
        \App\Models\ProductVideo::factory()->create([ 'product_id' => 1, 'url' => 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0' ]);
        \App\Models\ProductVideo::factory()->create([ 'product_id' => 1, 'url' => 'https://www.youtube.com/embed/8JNCCqsTaGg?rel=0' ]);
        \App\Models\ProductVideo::factory()->create([ 'product_id' => 1, 'url' => 'https://www.youtube.com/embed/NKiVjC4gn6Q?rel=0' ]);
        \App\Models\ProductVideo::factory()->create([ 'product_id' => 1, 'url' => 'https://www.youtube.com/embed/gZg-edVra64?rel=0' ]);
        //Videos

        //Repuestos
        \App\Models\ProductReplacement::factory()->create([ 'product_id' => 2, 'parent_product_id' => 1 ]);
        \App\Models\ProductReplacement::factory()->create([ 'product_id' => 3, 'parent_product_id' => 1 ]);
        \App\Models\ProductReplacement::factory()->create([ 'product_id' => 4, 'parent_product_id' => 1 ]);
        \App\Models\ProductReplacement::factory()->create([ 'product_id' => 5, 'parent_product_id' => 1 ]);
        //Repuestos

        //Partes
        \App\Models\ProductPart::factory()->create([ 'product_id' => 2, 'parent_product_id' => 1 ]);
        \App\Models\ProductPart::factory()->create([ 'product_id' => 3, 'parent_product_id' => 1 ]);
        \App\Models\ProductPart::factory()->create([ 'product_id' => 4, 'parent_product_id' => 1 ]);
        //Partes

        //Crear usuarios
        \App\Models\User::factory(50)->create();
        //Crear usuarios

        //Crear reviews
        \App\Models\ProductReview::factory(200)->create();
        //Crear reviews

        //Crear faqs
        \App\Models\ProductFaq::factory(200)->create();
        //Crear faqs

        //Crear catálogo de lista de precios
        \App\Models\CatalogPriceList::factory()->create([ 'catalog_country_id' => 1, 'name' => 'Sugerido' ]);
        \App\Models\CatalogPriceList::factory()->create([ 'catalog_country_id' => 1, 'name' => 'Mayoreo con Descuento' ]);
        //Crear catálogo de lista de precios

        //Crear catálogo de metodos de pago
        \App\Models\CatalogPaymentMethod::factory()->create([ 'catalog_country_id' => 1, 'name' => 'Mercado Libre', 'redirect_to' => 'https://www.nikkenlatam.com' ]);
        //Crear catálogo de metodos de pago
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_country_id')->constrained();
            $table->foreignId('catalog_product_brand_id')->constrained();
            $table->string('sku', 10)->index();
            $table->string('slug', 100)->index();
            $table->string('name', 100);
            $table->string('short_description');
            $table->text('description')->nullable();
            $table->text('differentiators')->nullable();
            $table->text('maintenance')->nullable();
            $table->string('image');
            $table->string('video')->nullable();
            $table->unsignedDecimal('wholesale_price', 10, 2);
            $table->unsignedDecimal('vat_wholesale_price', 10, 2);
            $table->unsignedDecimal('suggested_price', 10, 2);
            $table->unsignedDecimal('vat_suggested_price', 10, 2);
            $table->unsignedTinyInteger('vat_applies');
            $table->integer('stock');
            $table->unsignedTinyInteger('stock_applies');
            $table->unsignedInteger('points');
            $table->unsignedDecimal('vc', 10, 2);
            $table->unsignedDecimal('retail', 10, 2);
            $table->unsignedDecimal('vat_retail', 10, 2);
            $table->string('warranty', 100)->nullable();
            $table->unsignedDecimal('rating_total', 10, 1)->default(0);
            $table->dateTime('valid_from')->index()->nullable();
            $table->dateTime('valid_to')->index()->nullable();
            $table->dateTime('available_until')->nullable();
            $table->unsignedBigInteger('parent_product_id')->nullable();
            $table->tinyInteger('is_discontinued')->index()->default(0);
            $table->tinyInteger('is_purchasable')->index()->default(1);
            $table->tinyInteger('is_visible')->index()->default(0);
            $table->tinyInteger('status')->index()->default(1);
            $table->timestamps();

            $table->foreign('parent_product_id')->references('id')->on('products');

            //No permitir productos duplicados
            $table->unique([ 'catalog_country_id', 'sku' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

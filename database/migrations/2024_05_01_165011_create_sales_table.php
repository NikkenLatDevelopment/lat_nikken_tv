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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_country_id')->constrained();
            $table->foreignId('catalog_price_list_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedDecimal('subtotal', 10, 2);
            $table->unsignedDecimal('discount', 10, 2);
            $table->unsignedDecimal('iva', 10, 2);
            $table->unsignedDecimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

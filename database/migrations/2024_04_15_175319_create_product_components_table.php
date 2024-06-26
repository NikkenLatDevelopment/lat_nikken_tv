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
        Schema::create('product_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->unsignedBigInteger('parent_product_id');
            $table->timestamps();

            $table->foreign('parent_product_id')->references('id')->on('products');

            //No permitir componentes duplicados
            $table->unique([ 'product_id', 'parent_product_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_components');
    }
};

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
        Schema::create('catalog_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_country_id')->constrained();
            $table->string('name', 50);
            $table->unsignedTinyInteger('status')->index()->default(1);
            $table->timestamps();

            //No permitir formas de pago duplicadas
            $table->unique([ 'catalog_country_id', 'name' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_payment_methods');
    }
};

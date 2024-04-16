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
        Schema::create('catalog_countries', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2)->unique();
            $table->string('name', 60)->unique();
            $table->string('abbrev', 3)->unique();
            $table->unsignedDouble('vat', 10, 2);
            $table->string('currency_code', 3);
            $table->string('currency_symbol', 3);
            $table->unsignedTinyInteger('currency_decimal');
            $table->text('terms')->nullable();
            $table->text('privacy')->nullable();
            $table->text('closed_message')->nullable();
            $table->dateTime('closed_from')->index()->nullable();
            $table->dateTime('closed_to')->index()->nullable();
            $table->tinyInteger('status')->index()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_countries');
    }
};

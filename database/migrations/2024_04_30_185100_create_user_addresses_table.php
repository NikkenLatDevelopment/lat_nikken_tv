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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('catalog_country_id')->constrained();
            $table->string('name', 100)->index();
            $table->string('email', 80)->index();
            $table->string('phone', 30)->index()->nullable();
            $table->string('cellphone', 30)->index();
            $table->string('address', 100)->index();
            $table->string('complement_address', 100)->index()->nullable();
            $table->string('reference_address', 100)->index()->nullable();
            $table->string('state', 40)->index();
            $table->string('state_code', 20);
            $table->string('municipality', 40)->index();
            $table->string('municipality_code', 20);
            $table->string('colony', 40)->index()->nullable();
            $table->string('colony_code', 20)->nullable();
            $table->unsignedInteger('postal_code')->index()->nullable();
            $table->unsignedTinyInteger('status')->index()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};

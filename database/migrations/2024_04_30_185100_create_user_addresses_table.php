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
            $table->string('alias', 60)->index()->nullable();
            $table->string('name', 60)->index();
            $table->string('email', 100)->index();
            $table->string('phone', 30)->index()->nullable();
            $table->string('cellular', 15)->index();
            $table->string('address', 100)->index();
            $table->string('complement_address', 100)->index()->nullable();
            $table->string('reference_address', 100)->index()->nullable();
            $table->string('state', 40)->index();
            $table->string('state_code', 40);
            $table->string('municipality', 40)->index();
            $table->string('municipality_code', 40);
            $table->string('colony', 40)->index()->nullable();
            $table->string('colony_code', 40)->nullable();
            $table->integer('postal_code')->index()->nullable();
            $table->tinyInteger('status')->index()->default(1);
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

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name', 60);
            $table->string('address', 100);
            $table->string('complement_address', 100);
            $table->string('reference_address', 100);
            $table->string('state', 60);
            $table->string('state_code', 60);
            $table->string('municipality', 60);
            $table->string('municipality_code', 60);
            $table->string('colony', 60);
            $table->string('colony_code', 60);
            $table->string('postal_code', 10);
            $table->tinyInteger('status')->index()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

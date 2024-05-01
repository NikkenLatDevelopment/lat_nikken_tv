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
            $table->string('name', 60)->index()->nullable();
            $table->string('address', 100)->index();
            $table->string('complement_address', 100)->index()->nullable();
            $table->string('reference_address', 100)->index()->nullable();
            $table->string('state', 60)->index();
            $table->string('state_code', 60);
            $table->string('municipality', 60)->index();
            $table->string('municipality_code', 60);
            $table->string('colony', 60)->index()->nullable();
            $table->string('colony_code', 60)->nullable();
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

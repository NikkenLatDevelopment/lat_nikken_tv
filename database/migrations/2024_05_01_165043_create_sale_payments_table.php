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
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained();
            $table->unsignedDecimal('amount', 10, 2);
            $table->string('payment_gateway', 20);
            $table->string('payment_method', 20);
            $table->string('authorization', 20)->nullable();
            $table->string('transaction_id')->nullable();
            $table->unsignedTinyInteger('status')->index()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_payments');
    }
};

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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_country_id')->constrained();
            $table->string('slug', 100)->index();
            $table->string('name', 100);
            $table->string('image_desktop');
            $table->string('image_mobile');
            $table->string('redirect_url')->nullable();
            $table->dateTime('valid_from')->index()->nullable();
            $table->dateTime('valid_to')->index()->nullable();
            $table->tinyInteger('public_access')->index()->default(1);
            $table->tinyInteger('status')->index()->default(1);
            $table->timestamps();

            //No permitir campañas duplicadas
            $table->unique([ 'catalog_country_id', 'slug', 'name' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

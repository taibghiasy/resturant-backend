<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signature_dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->unsignedInteger('price')->default(0); // price in whole units (adjust if you need decimals)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signature_dishes');
    }
};

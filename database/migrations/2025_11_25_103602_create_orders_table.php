<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
    $table->id();

    $table->string('customer_name');
    $table->string('customer_phone');
    $table->string('address')->nullable();
    $table->string('district')->nullable();
    $table->date('delivery_date')->nullable();
    $table->time('delivery_time')->nullable();

    $table->enum('status', ['pending', 'preparing', 'on_the_way', 'delivered'])->default('pending');
    $table->decimal('total_price', 10, 2)->default(0);

    $table->timestamps();
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('orderDate');
            $table->enum('status',['PENDING','PROCESSING','SHIPPED','COMPLETED','CANCELED']);
            $table->decimal('totalAmount',10,2);
            $table->foreignId('user_id')
                ->constraided()
                ->onDelete('cascade');
            $table->foreignId('address_id')
                ->constraided();
            $table->foreignId('coupon_id')
                ->nullable()
                ->constrained();
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

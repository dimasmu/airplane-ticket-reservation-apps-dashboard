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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('flight_id')->constrained()->cascadeOnDelete();
            $table->foreignId('flight_class_id')->constrained()->cascadeOnDelete();
            $table->foreignId('promo_code_id')->nullable()->references('id')->on('promo_codes')->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->integer('number_of_passengers');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('grandtotal', 10, 2);
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'canceled']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

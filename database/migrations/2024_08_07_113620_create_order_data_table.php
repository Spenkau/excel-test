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
        Schema::create('order_data', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedBigInteger('orderItemId')->nullable();
            $table->unsignedBigInteger('user_balance_id')->nullable();
            $table->string('orderPlace')->nullable();
            $table->string('showcase')->nullable();
            $table->string('supplier')->nullable();
            $table->string('certificate')->nullable();
            $table->string('typeCard')->nullable();
            $table->string('numberCard')->nullable();
            $table->string('certificate_type')->nullable();
            $table->date('date')->nullable();
            $table->unsignedInteger('nominal')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedBigInteger('userID')->nullable();
            $table->string('username')->nullable();
            $table->string('userSurname')->nullable();
            $table->string('userLastname')->nullable();
            $table->unsignedBigInteger('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('recipient_userID')->nullable();
            $table->string('recipient_username')->nullable();
            $table->string('recipient_userSurname')->nullable();
            $table->string('recipient_userLastname')->nullable();
            $table->unsignedBigInteger('recipient_phone')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('status')->nullable();
            $table->string('paid')->nullable();
            $table->string('payment_method')->nullable();
            $table->date('date_generation')->nullable();
            $table->date('date_send')->nullable();
            $table->date('date_delivery')->nullable();
            $table->string('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_data');
    }
};

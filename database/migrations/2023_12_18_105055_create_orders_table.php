<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('address');
            $table->string('payment_status')->default('notPaid');
            $table->string('status')->default('');

            // Foriegn Keys for toys and user
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('toy_id');
            $table->engine = 'InnoDB';
            $table->foreign('toy_id')->references('id')->on('toys');
            $table->foreign('user_id')->references('id')->on('users');
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

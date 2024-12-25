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
        Schema::create('deposit_infos', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('userId');
            $table->string('transactionId');
            $table->string('paymentMethod');
            $table->string('paymentNumber');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_infos');
    }
};

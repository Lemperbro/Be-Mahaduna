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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->foreignId('tagihan_id')->constrained('tagihan')->references('tagihan_id');
            $table->text('invoice_id')->nullable();
            $table->string('external_id')->nullable();
            $table->text('payment_link')->nullable();
            $table->bigInteger('price');
            $table->bigInteger('pay')->nullable();
            $table->enum('payment_type', ['payment_gateway', 'manual']);
            $table->string('payment_status');
            $table->dateTime('expired')->nullable();
            $table->integer('user_created')->nullable();
            $table->timestamps();
            $table->integer('user_updated')->nullable();
            $table->softDeletes();
            $table->integer('user_deleted')->nullable();
            $table->integer('deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

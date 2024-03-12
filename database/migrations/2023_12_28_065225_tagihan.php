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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('tagihan_id');
            $table->foreignId('santri_id')->constrained('santri')->references('santri_id');
            $table->string('label', 200);
            $table->bigInteger('price');
            $table->date('date');
            $table->enum('status', ['belum dibayar', 'sudah dibayar', 'menunggu dibayar']);
            $table->enum('payment_type', ['cash', 'transfer'])->nullable();
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
        Schema::dropIfExists('tagihan');
    }
};

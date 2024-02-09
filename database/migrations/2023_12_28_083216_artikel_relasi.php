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
        Schema::create('artikel_relasi', function (Blueprint $table) {
            $table->id('artikel_relasi_id');
            $table->foreignId('artikel_id')->constrained('artikel')->references('artikel_id');
            $table->foreignId('artikel_kategori_id')->constrained('artikel_kategori')->references('artikel_kategori_id');
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
        Schema::dropIfExists('artikel_relasi');
    }
};

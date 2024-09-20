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
        Schema::create('monitor_mingguan', function (Blueprint $table) {
            $table->id('monitor_mingguan_id');
            $table->foreignId('santri_id')->constrained('santri')->references('santri_id');
            $table->integer('tidak_hadir');
            $table->integer('terlambat');
            $table->enum('kategori', ['sholat jamaah', 'ngaji']);
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
        Schema::dropIfExists('monitor_mingguan');
    }
};

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
        Schema::create('santri', function (Blueprint $table) {
            $table->id('santri_id');
            $table->foreignId('jenjang_id')->constrained('jenjang')->references('jenjang_id');
            $table->string('nama');
            $table->bigInteger('nisn');
            $table->date('tgl_masuk');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('status', ['aktif', 'lulus']);
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
        Schema::dropIfExists('santri');
    }
};

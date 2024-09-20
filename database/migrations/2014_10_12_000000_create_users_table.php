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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->text('image');
            $table->string('username', 150);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('telp', 20);
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['super admin', 'dirosah', 'media', 'addiya', 'bendahara']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

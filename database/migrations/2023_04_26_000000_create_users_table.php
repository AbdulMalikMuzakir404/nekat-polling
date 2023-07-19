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
            $table->id();
            $table->string('nama', 50);
            $table->string('nis', 15)->nullable()->unique();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 80);
            $table->string('password_show', 80)->nullable();
            $table->enum('role', ['admin', 'panitia', 'siswa'])->default('siswa');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('voting')->default(false);
            $table->rememberToken();

            $table->foreignId('polling_id')->nullable();
            $table->timestamps();
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

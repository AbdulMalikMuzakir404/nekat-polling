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
        Schema::create('parent_users', function (Blueprint $table) {
            $table->id();
            $table->enum('kelas', ['X', 'XI', 'XII', 'XIII']);
            $table->string('jurusan', 20);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_users');
    }
};

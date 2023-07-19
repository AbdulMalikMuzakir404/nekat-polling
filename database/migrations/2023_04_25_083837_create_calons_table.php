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
        Schema::create('calons', function (Blueprint $table) {
            $table->id();
            $table->string('nama_calon', 50);
            $table->string('nama_wakil_calon', 50)->nullable();
            $table->string('nis_calon', 15);
            $table->string('nis_wakil_calon', 15);
            $table->text('visi');
            $table->text('misi');
            $table->integer('suara')->default(0);
            $table->string('team', 10);
            $table->boolean('status_polling')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calons');
    }
};

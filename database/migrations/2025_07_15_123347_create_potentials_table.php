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
        Schema::create('potentials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL ramah SEO jika diperlukan detail potensi
            $table->text('description');
            $table->string('image')->nullable(); // Gambar untuk potensi (opsional)
            $table->boolean('is_published')->default(true); // Status publikasi
            $table->integer('order')->nullable(); // Untuk urutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potentials');
    }
};

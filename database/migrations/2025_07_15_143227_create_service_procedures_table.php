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
        Schema::create('service_procedures', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul prosedur, misal: "Prosedur Pengurusan KTP"
            $table->string('slug')->unique(); // Untuk URL ramah SEO
            $table->text('description')->nullable(); // Deskripsi singkat
            $table->longText('steps_requirements'); // Detail langkah-langkah dan persyaratan (bisa HTML)
            $table->string('category')->nullable(); // Kategori (misal: Kependudukan, Pertanahan, Umum)
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
        Schema::dropIfExists('service_procedures');
    }
};

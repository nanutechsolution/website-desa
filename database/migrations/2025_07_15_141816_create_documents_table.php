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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL yang ramah SEO atau unik
            $table->text('description')->nullable();
            $table->string('file_path'); // Path ke file dokumen (PDF, DOCX, dll.)
            $table->string('file_type')->nullable(); // Jenis file (pdf, docx, xlsx)
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
        Schema::dropIfExists('documents');
    }
};

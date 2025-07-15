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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL yang ramah SEO
            $table->text('content');
            $table->string('image')->nullable(); // Gambar sampul berita
            $table->string('author')->nullable(); // Penulis berita, bisa ID user admin atau string
            $table->timestamp('published_at')->nullable(); // Kapan berita dipublikasikan
            $table->boolean('is_published')->default(false); // Status publikasi (Draft/Published)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

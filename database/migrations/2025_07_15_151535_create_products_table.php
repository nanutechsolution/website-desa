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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Produk
            $table->string('slug')->unique(); // Slug untuk URL produk
            $table->text('short_description')->nullable(); // Deskripsi singkat
            $table->longText('description')->nullable(); // Deskripsi lengkap (bisa HTML)
            $table->decimal('price', 10, 2)->nullable(); // Harga produk
            $table->string('image')->nullable(); // Gambar produk
            $table->string('category')->nullable(); // Kategori produk (misal: Makanan, Kerajinan, Pertanian)
            $table->string('contact_person')->nullable(); // Nama kontak penjual
            $table->string('contact_phone')->nullable(); // Nomor telepon kontak penjual
            $table->string('contact_email')->nullable(); // Email kontak penjual
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
        Schema::dropIfExists('products');
    }
};

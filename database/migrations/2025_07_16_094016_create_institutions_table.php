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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama lembaga, misal: "PKK Desa Orakeri", "BUMDes Maju Bersama"
            $table->string('slug')->unique(); // Untuk URL detail lembaga
            $table->string('leader_name')->nullable(); // Nama ketua/pimpinan lembaga
            $table->text('description')->nullable(); // Deskripsi atau profil lembaga
            $table->string('category')->nullable(); // Kategori (misal: Kelembagaan Masyarakat, Ekonomi, Pendidikan, Keamanan)
            $table->string('image')->nullable(); // Logo atau gambar representasi lembaga
            $table->string('contact_phone')->nullable(); // Telepon lembaga
            $table->string('contact_email')->nullable(); // Email lembaga
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
        Schema::dropIfExists('institutions');
    }
};
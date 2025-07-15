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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news')->onDelete('cascade'); // Komentar terhubung ke artikel berita
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Jika user login
            $table->string('guest_name')->nullable(); // Nama guest jika tidak login
            $table->string('guest_email')->nullable(); // Email guest jika tidak login
            $table->text('content'); // Isi komentar
            $table->boolean('is_approved')->default(false); // Status moderasi (false = pending, true = disetujui)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

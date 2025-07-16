<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan ini jika menggunakan DB::statement

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profile_contents', function (Blueprint $table) {
            // Ubah tipe kolom 'content' menjadi longText
            $table->longText('content')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_contents', function (Blueprint $table) {
            // Jika Anda ingin mengembalikan ke tipe 'text' saat rollback
            // Perhatikan: Data yang melebihi batas 'text' akan terpotong
            $table->text('content')->change();
        });
    }
};
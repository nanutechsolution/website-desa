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
        Schema::table('profile_contents', function (Blueprint $table) {
            // Ubah kolom 'content' agar bisa menerima nilai NULL
            $table->longText('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_contents', function (Blueprint $table) {
            // Saat rollback, kembalikan ke NOT NULL (jika ini yang diinginkan)
            // HATI-HATI: Jika ada data NULL, rollback ini akan gagal.
            $table->longText('content')->change(); // Ini akan mengembalikannya ke NOT NULL jika default MySQL adalah NOT NULL
            // Atau untuk memastikan NOT NULL:
            // $table->longText('content')->nullable(false)->change();
        });
    }
};

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
            $table->string('title')->nullable()->after('key'); // Tambah kolom title
            $table->string('type')->default('text')->after('content'); // Tambah kolom type (default 'text')
            $table->boolean('is_published')->default(true)->after('type'); // Tambah kolom is_published (default true)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_contents', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('type');
            $table->dropColumn('is_published');
        });
    }
};
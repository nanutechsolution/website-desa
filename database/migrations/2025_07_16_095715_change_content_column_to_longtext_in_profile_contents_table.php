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
            // Hapus kolom HEX lama jika ada (ini untuk migrasi dari versi HEX)
            if (Schema::hasColumn('profile_contents', 'brand_primary_color')) {
                $table->dropColumn(['brand_primary_color', 'brand_secondary_color', 'brand_accent_color']);
            }
            // Tambahkan kolom HSL baru
            // UBAH 'after' di sini untuk semua kolom HSL
            $table->string('brand_primary_hue')->nullable()->after('is_published'); // <--- PERBAIKI INI
            $table->string('brand_primary_saturation')->nullable()->after('brand_primary_hue');
            $table->string('brand_primary_lightness')->nullable()->after('brand_primary_saturation');

            $table->string('brand_secondary_hue')->nullable()->after('brand_primary_lightness');
            $table->string('brand_secondary_saturation')->nullable()->after('brand_secondary_hue');
            $table->string('brand_secondary_lightness')->nullable()->after('brand_secondary_saturation');

            $table->string('brand_accent_hue')->nullable()->after('brand_secondary_lightness');
            $table->string('brand_accent_saturation')->nullable()->after('brand_accent_hue');
            $table->string('brand_accent_lightness')->nullable()->after('brand_accent_saturation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_contents', function (Blueprint $table) {
            $table->dropColumn([
                'brand_primary_hue',
                'brand_primary_saturation',
                'brand_primary_lightness',
                'brand_secondary_hue',
                'brand_secondary_saturation',
                'brand_secondary_lightness',
                'brand_accent_hue',
                'brand_accent_saturation',
                'brand_accent_lightness',
            ]);
            // Jika ingin mengembalikan kolom HEX lama saat rollback
            // $table->string('brand_primary_color')->nullable()->after('footer_about');
            // $table->string('brand_secondary_color')->nullable()->after('brand_primary_color');
            // $table->string('brand_accent_color')->nullable()->after('brand_secondary_color');
        });
    }
};
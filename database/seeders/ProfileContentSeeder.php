<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfileContent;

class ProfileContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileContent::create([
            'key' => 'visi',
            'content' => 'Terwujudnya Desa Orakeri yang mandiri, sejahtera, dan berbudaya dengan mengedepankan partisipasi masyarakat serta kelestarian lingkungan untuk masa depan yang gemilang.'
        ]);

        ProfileContent::create([
            'key' => 'misi',
            'content' => '<ul><li>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan yang berkelanjutan.</li><li>Mengembangkan potensi ekonomi lokal melalui UMKM dan pariwisata berbasis masyarakat.</li><li>Meningkatkan dan merawat infrastruktur desa untuk mendukung aktivitas warga.</li><li>Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan partisipatif.</li><li>Melestarikan nilai-nilai budaya dan kearifan lokal serta menjaga keberlanjutan lingkungan hidup.</li></ul>'
        ]);

        ProfileContent::create([
            'key' => 'sejarah',
            'content' => '<p>Desa Orakeri memiliki sejarah panjang yang berakar pada masa lampau, dimulai dari pemukiman awal yang didirikan oleh para leluhur yang mencari lahan subur di tepi sungai. Nama "Orakeri" sendiri diyakini berasal dari kisah legenda lokal tentang...</p><p>Sejak itu, desa ini telah berkembang melalui berbagai era, dari perjuangan mempertahankan kemerdekaan hingga pembangunan di era modern. Gotong royong dan semangat kebersamaan selalu menjadi fondasi kuat yang menyatukan masyarakat Orakeri.</p>'
        ]);

        ProfileContent::create([
            'key' => 'struktur_pemerintahan',
            'content' => '<p>Berikut adalah bagan struktur pemerintahan Desa Orakeri yang bertugas melayani masyarakat dengan sepenuh hati:</p><ol><li><strong>Kepala Desa:</strong> [Nama Kepala Desa]</li><li><strong>Sekretaris Desa:</strong> [Nama Sekretaris Desa]</li><li><strong>Kepala Urusan (Kaur) Tata Usaha dan Umum:</strong> [Nama Kaur TU]</li><li><strong>Kepala Urusan (Kaur) Keuangan:</strong> [Nama Kaur Keuangan]</li><li><strong>Kepala Seksi (Kasi) Pemerintahan:</strong> [Nama Kasi Pemerintahan]</li><li><strong>Kepala Seksi (Kasi) Kesejahteraan:</strong> [Nama Kasi Kesejahteraan]</li><li><strong>Kepala Seksi (Kasi) Pelayanan:</strong> [Nama Kasi Pelayanan]</li><li><strong>Kepala Dusun (Kadus) I:</strong> [Nama Kadus I]</li><li><strong>Kepala Dusun (Kadus) II:</strong> [Nama Kadus II]</li><li><strong>BPD (Badan Permusyawaratan Desa):</strong> [Daftar Anggota BPD]</li></ol>'
        ]);

        ProfileContent::create([
            'key' => 'sekilas_desa',
            'content' => '<p>Desa Orakeri adalah sebuah permata tersembunyi yang kaya akan tradisi, keindahan alam, dan keramahan penduduknya. Kami mengundang Anda untuk menjelajahi potensi pertanian organik kami, keunikan UMKM lokal, serta pesona wisata alam yang menyejukkan jiwa. Mari bersama membangun Desa Orakeri yang mandiri, sejahtera, dan lestari.</p>'
        ]);
    }
}

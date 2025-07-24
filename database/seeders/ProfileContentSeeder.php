<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfileContent; // Pastikan ini ada
use Faker\Factory as Faker; // Pastikan ini ada

class ProfileContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PENTING: Dapatkan instance faker di awal run()
        $faker = Faker::create('id_ID'); // Menggunakan Faker bahasa Indonesia

        // Helper function untuk konversi HEX ke HSL (approximate)
        // Fungsi ini harus berada di dalam kelas ProfileContentSeeder
        if (!function_exists('hexToHsl')) { // Cek agar tidak redeclare jika dipanggil lebih dari sekali
            function hexToHsl($hex)
            {
                list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
                $r /= 255;
                $g /= 255;
                $b /= 255;
                $max = max($r, $g, $b);
                $min = min($r, $g, $b);
                $h = $s = $l = ($max + $min) / 2;

                if ($max === $min) {
                    $h = $s = 0; // achromatic
                } else {
                    $d = $max - $min;
                    $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
                    switch ($max) {
                        case $r:
                            $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                            break;
                        case $g:
                            $h = ($b - $r) / $d + 2;
                            break;
                        case $b:
                            $h = ($r - $g) / $d + 4;
                            break;
                    }
                    $h /= 6;
                }
                return [round($h * 360), round($s * 100), round($l * 100)];
            }
        }


        // --- Data Konten Profil Dinamis ---

        // Visi Desa
        ProfileContent::firstOrCreate(
            ['key' => 'visi'],
            [
                'title' => 'Visi Desa',
                'content' => '<p>Mewujudkan Desa Orakeri yang mandiri, sejahtera, dan berbudaya, dengan mengedepankan potensi lokal dan partisipasi aktif masyarakat.</p>',
                'type' => 'richtext',
                'is_published' => true,
            ]
        );

        // Misi Desa
        ProfileContent::firstOrCreate(
            ['key' => 'misi'],
            [
                'title' => 'Misi Desa',
                'content' => '<p>1. Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan.</p><p>2. Mengembangkan potensi ekonomi desa berbasis pertanian dan UMKM.</p><p>3. Melestarikan adat istiadat dan budaya lokal.</p><p>4. Meningkatkan kualitas pelayanan publik yang transparan dan akuntabel.</p>',
                'type' => 'richtext',
                'is_published' => true,
            ]
        );

        // Sejarah Desa
        ProfileContent::firstOrCreate(
            ['key' => 'sejarah'],
            [
                'title' => 'Sejarah Desa',
                'content' => '<p>Desa Orakeri memiliki sejarah panjang yang berakar pada masa lampau, dimulai dari pemukiman awal yang didirikan oleh para leluhur yang mencari lahan subur di tepi sungai. Nama "Orakeri" sendiri diyakini berasal dari kata kuno yang berarti "tempat berkumpulnya para petani". Sejak awal berdirinya, desa ini dikenal sebagai lumbung pangan dan pusat kerajinan tangan tradisional.</p><p>Pada masa penjajahan, Desa Orakeri menjadi salah satu basis perjuangan rakyat. Banyak pahlawan lokal yang lahir dari desa ini, berjuang mempertahankan tanah air. Setelah kemerdekaan, Desa Orakeri terus berkembang menjadi desa yang makmur, dengan tetap menjaga nilai-nilai luhur nenek moyang.</p>',
                'type' => 'richtext',
                'is_published' => true,
            ]
        );

        // Struktur Pemerintahan Desa
        ProfileContent::firstOrCreate(
            ['key' => 'struktur_pemerintahan'],
            [
                'title' => 'Struktur Pemerintahan Desa',
                'content' => '
                    <p>Berikut adalah bagan struktur pemerintahan Desa Orakeri yang bertugas melayani masyarakat dengan sepenuh hati. Setiap posisi diisi oleh individu yang berdedikasi untuk kemajuan desa.</p>
                    <p><img src="https://source.unsplash.com/random/800x600/?organization-chart,hierarchy,chart" alt="Bagan Struktur Pemerintahan Desa" style="max-width: 100%; height: auto; display: block; margin: 20px auto;"></p>
                    
                    <h3>A. Kepala Desa</h3>
                    <p><strong>Kepala Desa:</strong> ' . $faker->name('male') . '</p>

                    <h3>B. Perangkat Desa</h3>
                    <p><strong>1. Sekretariat Desa</strong></p>
                    <ul>
                        <li><strong>Sekretaris Desa:</strong> ' . $faker->name() . '</li>
                        <li><strong>Kepala Urusan Tata Usaha dan Umum:</strong> ' . $faker->name() . '</li>
                        <li><strong>Kepala Urusan Keuangan:</strong> ' . $faker->name() . '</li>
                        <li><strong>Kepala Urusan Perencanaan:</strong> ' . $faker->name() . '</li>
                    </ul>

                    <p><strong>2. Pelaksana Teknis</strong></p>
                    <ul>
                        <li><strong>Kepala Seksi Pemerintahan:</strong> ' . $faker->name() . '</li>
                        <li><strong>Kepala Seksi Kesejahteraan:</strong> ' . $faker->name() . '</li>
                        <li><strong>Kepala Seksi Pelayanan:</strong> ' . $faker->name() . '</li>
                    </ul>
                    
                    <h3>C. Kewilayahan (Kepala Dusun / Kepala Wilayah)</h3>
                    <ul>
                        <li><strong>Kepala Dusun I (Dusun Mawar):</strong> ' . $faker->name() . '</li>
                        <li><strong>Kepala Dusun II (Dusun Melati):</strong> ' . $faker->name() . '</li>
                        <li><strong>Kepala Dusun III (Dusun Anggrek):</strong> ' . $faker->name() . '</li>
                    </ul>

                    <h3>D. Rukun Tetangga (Contoh)</h3>
                    <p>Desa Orakeri memiliki [Jumlah RT: ' . $faker->numberBetween(10, 20) . '] Rukun Tetangga yang tersebar di seluruh wilayah dusun.</p>
                    <p>Berikut adalah beberapa contoh Ketua RT:</p>
                    <ul>
                        <li><strong>Ketua RT 001/RW 001 (Dusun Mawar):</strong> ' . $faker->name() . '</li>
                        <li><strong>Ketua RT 002/RW 001 (Dusun Mawar):</strong> ' . $faker->name() . '</li>
                        <li><strong>Ketua RT 001/RW 002 (Dusun Melati):</strong> ' . $faker->name() . '</li>
                    </ul>
                    <p>Untuk daftar lengkap Ketua RT dan RW, silakan hubungi Kantor Desa.</p>
                ',
                'type' => 'richtext',
                'is_published' => true,
            ]
        );

        // Sekilas Desa
        ProfileContent::firstOrCreate(
            ['key' => 'sekilas_desa'],
            [
                'title' => 'Sekilas Desa',
                'content' => '<p>Desa Orakeri adalah sebuah permata tersembunyi yang kaya akan tradisi, keindahan alam, dan keramahan penduduknya. Kami mengundang Anda untuk menjelajahi potensi pertanian organik kami, keunikan UMKM lokal, serta pesona wisata alam yang menyejukkan jiwa. Mari bersama membangun Desa Orakeri yang mandiri, sejahtera, dan lestari.</p>',
                'type' => 'richtext',
                'is_published' => true,
            ]
        );

        // --- Data Kontak Dinamis ---
        ProfileContent::firstOrCreate(
            ['key' => 'contact_address'],
            [
                'title' => 'Alamat Kantor Desa',
                'content' => 'Jl. Raya Desa Orakeri No. 123, Kecamatan Sejahtera, Kabupaten Harmoni, Jawa Barat 43211',
                'type' => 'text',
                'is_published' => true,
            ]
        );
        ProfileContent::firstOrCreate(
            ['key' => 'contact_phone'],
            [
                'title' => 'Nomor Telepon Desa',
                'content' => '(022) 123-456798',
                'type' => 'text',
                'is_published' => true,
            ]
        );
        ProfileContent::firstOrCreate(
            ['key' => 'contact_email'],
            [
                'title' => 'Email Desa',
                'content' => 'info@desaorakeri.com',
                'type' => 'text',
                'is_published' => true,
            ]
        );

        // --- Data Koordinat Google Maps (KOREKSI NAMA KEY DI SINI) ---
        ProfileContent::firstOrCreate(
            ['key' => 'Maps_latitude'],
            [
                'title' => 'Garis Lintang Google Maps',
                'content' => '-7.795580', // Contoh Latitude untuk Yogyakarta
                'type' => 'text',
                'is_published' => true,
            ]
        );
        ProfileContent::firstOrCreate(
            ['key' => 'Maps_longitude'],
            [
                'title' => 'Garis Bujur Google Maps',
                'content' => '110.368944', // Contoh Longitude untuk Yogyakarta
                'type' => 'text',
                'is_published' => true,
            ]
        );

        // Data Konten Footer Dinamis
        ProfileContent::firstOrCreate(
            ['key' => 'footer_about'],
            [
                'title' => 'Teks Tentang Desa di Footer',
                'content' => 'Desa Orakeri adalah komunitas yang kaya budaya dan potensi alam, berkomitmen membangun desa yang mandiri, sejahtera, dan lestari dengan partisipasi masyarakat aktif.',
                'type' => 'text',
                'is_published' => true,
            ]
        );

        // Nama Desa Dinamis
        ProfileContent::firstOrCreate(
            ['key' => 'village_name'],
            [
                'title' => 'Nama Desa',
                'content' => 'Desa Orakeri',
                'type' => 'text',
                'is_published' => true,
            ]
        );

        // Logo Website Utama
        ProfileContent::firstOrCreate(
            ['key' => 'site_logo'],
            [
                'title' => 'Logo Website Utama',
                'content' => 'images/logo.jpg', // <--- Periksa PATH INI
                'type' => 'image',
                'is_published' => true,
            ]
        );

        // Deskripsi Meta Situs Web
        ProfileContent::firstOrCreate(
            ['key' => 'site_meta_description'],
            [
                'title' => 'Deskripsi Meta Situs Web',
                'content' => 'Website resmi Desa Orakeri. Temukan informasi terbaru, potensi desa, galeri foto, produk lokal, dan layanan administrasi online. Jelajahi keindahan dan kehidupan komunitas kami.',
                'type' => 'text',
                'is_published' => true,
            ]
        );
        ProfileContent::firstOrCreate(
            ['key' => 'brand_primary_color_hsl'], // Key ini akan menyimpan HEX di 'content'
            [
                'title' => 'Warna Utama Branding',
                'content' => '#4CAF50', // Simpan HEX langsung di content
                'type' => 'color',
                'is_published' => true,
            ]
        );
        ProfileContent::firstOrCreate(
            ['key' => 'brand_secondary_color_hsl'],
            [
                'title' => 'Warna Sekunder Branding',
                'content' => '#2196F3', // Simpan HEX langsung di content
                'type' => 'color',
                'is_published' => true,
            ]
        );
        ProfileContent::firstOrCreate(
            ['key' => 'brand_accent_color_hsl'],
            [
                'title' => 'Warna Aksen Branding',
                'content' => '#795548', // Simpan HEX langsung di content
                'type' => 'color',
                'is_published' => true,
            ]
        );
    }

    // Pastikan helper faker ada
    protected function faker()
    {
        return \Faker\Factory::create('id_ID');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileContent;
use Faker\Factory as Faker;

class ProfileContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan Faker bahasa Indonesia

        // Visi Desa
        ProfileContent::firstOrCreate(
            ['key' => 'visi'],
            [
                'title' => 'Visi Desa', // <-- Kolom baru
                'content' => '<p>Mewujudkan Desa Orakeri yang mandiri, sejahtera, dan berbudaya, dengan mengedepankan potensi lokal dan partisipasi aktif masyarakat.</p>',
                'type' => 'richtext', // <-- Kolom baru
                'is_published' => true, // <-- Kolom baru
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

        // Data Kontak Dinamis
        ProfileContent::firstOrCreate(
            ['key' => 'contact_address'],
            [
                'title' => 'Alamat Kantor Desa',
                'content' => 'Jl. Raya Desa Orakeri No. 123, Kecamatan Sejahtera, Kabupaten Harmoni, Jawa Barat 43211',
                'type' => 'text', // Tipe text karena biasanya singkat
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
        ProfileContent::firstOrCreate(
            ['key' => 'Maps_embed'],
            [
                'title' => 'URL Google Maps Embed',
                'content' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50401.81578724136!2d110.4619592!3d-7.780961599999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a51b96c72a851%3A0xf454bd5877f00a2e!2sLava%20Bantal!5e1!3m2!1sid!2sid!4v1752754980086!5m2!1sid!2sid',
                'type' => 'url',
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
    }
}
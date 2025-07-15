# 🏡 Aplikasi Website Resmi Desa Orakeri

Sistem informasi dan promosi desa modern yang dibangun dengan **Laravel 12** sebagai backend dan **Tailwind CSS** sebagai framework CSS. Aplikasi ini bertujuan untuk menyediakan platform digital bagi Pemerintah Desa Orakeri dalam menyampaikan informasi, mempromosikan potensi dan produk desa, serta memfasilitasi layanan kepada masyarakat secara online.

## ✨ Fitur Utama:

* **🌐 Antarmuka Publik (Frontend):**
    * **Hero Slider:** Tampilan utama dinamis dengan gambar dan teks yang dapat dikelola.
    * **Profil Desa:** Halaman khusus untuk Visi & Misi, Sejarah Desa, dan Struktur Pemerintahan yang dapat diperbarui dari admin.
    * **Potensi Desa:** Katalog potensi unggulan desa (pertanian, UMKM, pariwisata) dengan detail dan gambar.
    * **Berita:** Modul berita dan pengumuman terbaru desa yang dapat diakses publik.
    * **Galeri:** Album foto dan video yang menampilkan kegiatan dan keindahan desa.
    * **Produk Desa:** Showcase produk-produk unggulan masyarakat desa dengan informasi kontak penjual.
    * **Layanan Online:** Formulir pengajuan surat online dan daftar prosedur layanan administrasi desa.
    * **Dokumen Publik:** Repositori dokumen-dokumen resmi desa yang dapat diunduh.
    * **Kontak:** Halaman informasi kontak desa dengan formulir pesan dan peta lokasi (Google Maps).
    * **Fitur Komentar:** Pengunjung dapat meninggalkan komentar pada artikel berita (membutuhkan moderasi admin dan perlindungan reCAPTCHA).
    * **Animasi AOS:** Efek animasi saat menggulir (scroll) untuk pengalaman pengguna yang lebih dinamis.
    * **Desain Responsif:** Tampilan yang adaptif di berbagai perangkat (mobile, tablet, desktop).
* **🔒 Dasbor Admin (Backend):**
    * **Sistem Autentikasi:** Menggunakan Laravel Breeze untuk login/logout admin yang aman.
    * **Manajemen Konten (CRUD):** Modul CRUD lengkap untuk mengelola Hero Slider, Berita, Galeri, Potensi Desa, Produk Desa, Dokumen Publik, dan Prosedur Layanan.
    * **Moderasi Komentar:** Fitur untuk meninjau, menyetujui, menolak, atau menghapus komentar yang masuk.
    * **Pengaturan Profil Desa:** Form untuk memperbarui konten Visi, Misi, Sejarah, Struktur Pemerintahan, dan Sekilas Desa.
    * **Editor WYSIWYG:** Integrasi TinyMCE untuk memudahkan penulisan konten kaya (rich text).
    * **Pencarian & Paginasi:** Fitur pencarian client-side dan paginasi di tabel admin untuk memudahkan pengelolaan data.
    * **Pengelolaan File:** Upload dan pengelolaan gambar/dokumen melalui sistem penyimpanan Laravel.

## 🚀 Tumpukan Teknologi:

* **Backend:** PHP 8.2+ (Laravel Framework 12.20.0)
* **Database:** MySQL / SQLite
* **Frontend:** Blade Templating Engine, Tailwind CSS (dengan Vite), Alpine.js, AOS (Animate On Scroll), Google reCAPTCHA v2.
* **Pengembangan:** Laragon (lingkungan pengembangan lokal)

## 🛠️ Instalasi & Penggunaan:

Ikuti langkah-langkah di bawah ini untuk menyiapkan proyek di lingkungan lokal Anda.

1.  **📥 Kloning Repositori:**
    ```bash
    git clone [https://github.com/Radianus/desa-orakeri-website.git
    cd desa-orakeri-website
    ```
    *(Ganti `USERNAME` dengan username GitHub Anda dan `desa-orakeri-website` dengan nama repositori Anda jika berbeda.)*

2.  **📦 Instal Dependensi PHP:**
    ```bash
    composer install
    ```

3.  **⚙️ Buat File `.env` & Generate Kunci Aplikasi:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    * Buka file `.env`.
    * Konfigurasi koneksi database Anda (misal: `DB_CONNECTION=sqlite`, dan buat file `database/database.sqlite`).
    * Tambahkan dan konfigurasi kunci Google reCAPTCHA v2 Anda:
        ```dotenv
        NOCAPTCHA_SITEKEY=YOUR_RECAPTCHA_SITE_KEY
        NOCAPTCHA_SECRET=YOUR_RECAPTCHA_SECRET_KEY
        ```
        *(Dapatkan kunci Anda dari [Google reCAPTCHA Admin](https://www.google.com/recaptcha/admin/)). Pastikan Anda menambahkan `localhost`, `127.0.0.1`, dan `127.0.0.1:8000` ke daftar domain yang disetujui di pengaturan reCAPTCHA Anda.)*
    * Konfigurasi TinyMCE API Key di `resources/views/components/admin-layout.blade.php` (ganti `YOUR_TINYMCE_API_KEY`).

4.  **📊 Jalankan Migrasi Database & Seeder:**
    Perintah ini akan menghapus semua tabel yang ada (jika ada), menjalankan semua migrasi, dan mengisi database dengan data dummy awal. **Ini penting untuk mengisi data awal seperti berita, user admin, dll.**
    ```bash
    php artisan migrate:fresh --seed
    ```
    * Ini akan membuat user admin default: **Email:** `admin@desa.com` | **Password:** `password`

5.  **🌐 Instal Dependensi JavaScript & Kompilasi Aset Frontend:**
    ```bash
    npm install
    npm run dev
    ```
    *(Untuk produksi: `npm run build`)*

6.  **🔗 Buat Symlink Penyimpanan Publik:**
    ```bash
    php artisan storage:link
    ```
    *(Pastikan Anda telah menempatkan beberapa gambar dummy di `storage/app/public/` sesuai dengan konfigurasi Factory Anda, atau Anda akan melihat gambar placeholder jika menggunakan URL online.)*

7.  **🧹 Bersihkan Cache Laravel:**
    ```bash
    php artisan optimize:clear
    ```

8.  **▶️ Jalankan Server Pengembangan Laravel:**
    ```bash
    php artisan serve
    ```

## 🚀 Akses Aplikasi:

* **Frontend Publik:** Buka browser Anda dan navigasi ke `http://127.0.0.1:8000`
* **Dasbor Admin:** Buka `http://127.0.0.1:8000/admin/dashboard`
    * Login dengan kredensial admin default (`admin@desa.com` / `password`).

---

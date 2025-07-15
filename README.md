
# Aplikasi Website Resmi Desa Orakeri

Sistem informasi dan promosi desa modern yang dibangun dengan **Laravel 12** sebagai backend dan **Tailwind CSS** sebagai framework CSS. Aplikasi ini bertujuan untuk menyediakan platform digital bagi Pemerintah Desa Orakeri dalam menyampaikan informasi, mempromosikan potensi dan produk desa, serta memfasilitasi layanan kepada masyarakat secara online.

## Fitur Utama:

* **Antarmuka Publik (Frontend):**
    * **Hero Slider:** Tampilan utama dinamis dengan gambar dan teks yang dapat dikelola.
    * **Profil Desa:** Halaman khusus untuk Visi & Misi, Sejarah Desa, dan Struktur Pemerintahan yang dapat diperbarui dari admin.
    * **Potensi Desa:** Katalog potensi unggulan desa (pertanian, UMKM, pariwisata) dengan detail dan gambar.
    * **Berita:** Modul berita dan pengumuman terbaru desa yang dapat diakses publik.
    * **Galeri:** Album foto dan video yang menampilkan kegiatan dan keindahan desa.
    * **Produk Desa:** Showcase produk-produk unggulan masyarakat desa dengan informasi kontak penjual.
    * **Layanan Online:** Formulir pengajuan surat online dan daftar prosedur layanan administrasi desa.
    * **Dokumen Publik:** Repositori dokumen-dokumen resmi desa yang dapat diunduh.
    * **Kontak:** Halaman informasi kontak desa dengan formulir pesan dan peta lokasi (Google Maps).
    * **Animasi AOS:** Efek animasi saat menggulir (scroll) untuk pengalaman pengguna yang lebih dinamis.
    * **Desain Responsif:** Tampilan yang adaptif di berbagai perangkat (mobile, tablet, desktop).
* **Dasbor Admin (Backend):**
    * **Sistem Autentikasi:** Menggunakan Laravel Breeze untuk login/logout admin yang aman.
    * **Manajemen Konten (CRUD):** Modul CRUD lengkap untuk mengelola Hero Slider, Berita, Galeri, Potensi Desa, Produk Desa, Dokumen Publik, dan Prosedur Layanan.
    * **Moderasi Komentar:** Fitur untuk menyetujui, menolak, atau menghapus komentar yang masuk.
    * **Pengaturan Profil Desa:** Form untuk memperbarui konten Visi, Misi, Sejarah, dan Struktur Pemerintahan desa.
    * **Editor WYSIWYG:** Integrasi TinyMCE untuk memudahkan penulisan konten kaya (rich text).
    * **Pencarian & Paginasi:** Fitur pencarian dan paginasi di tabel admin untuk memudahkan pengelolaan data.
    * **Pengelolaan File:** Upload dan pengelolaan gambar/dokumen melalui sistem penyimpanan Laravel.

## Tumpukan Teknologi:

* **Backend:** PHP 8.2+ (Laravel Framework 12.20.0)
* **Database:** MySQL / SQLite
* **Frontend:** Blade Templating Engine, Tailwind CSS (dengan Vite), Alpine.js, AOS (Animate On Scroll), Google reCAPTCHA v2.
* **Pengembangan:** Laragon (lingkungan pengembangan lokal)

## Instalasi & Penggunaan:

1.  **Kloning Repositori:**
    ```bash
    git clone [https://github.com/USERNAME/desa-orakeri-website.git](https://github.com/Radianus/desa-orakeri-website.git)
    cd desa-orakeri-website
    ```
2.  **Instal Dependensi PHP:**
    ```bash
    composer install
    ```
3.  **Buat File `.env`:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Konfigurasi database dan kunci API reCAPTCHA Anda di file `.env`.
4.  **Konfigurasi Database & Jalankan Migrasi:**
    Atur koneksi database di `.env`, lalu jalankan migrasi dan seeder:
    ```bash
    php artisan migrate:fresh --seed
    ```
    (Ini akan membuat tabel dan mengisi data dummy, termasuk user admin: `admin@desa.com` / `password`).
5.  **Instal Dependensi JavaScript & Kompilasi Aset:**
    ```bash
    npm install
    npm run dev
    ```
    (Untuk produksi: `npm run build`)
6.  **Buat Symlink Penyimpanan:**
    ```bash
    php artisan storage:link
    ```
7.  **Jalankan Server:**
    ```bash
    php artisan serve
    ```
8.  Akses aplikasi di browser: `http://127.0.0.1:8000` (Frontend) dan `http://127.0.0.1:8000/admin/dashboard` (Admin Panel).

---

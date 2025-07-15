// resources/js/app.js
import './bootstrap'; // Ini bawaan Breeze
import Alpine from 'alpinejs'; // Ini bawaan Breeze
import AOS from 'aos'; // Tambahkan ini

window.Alpine = Alpine;

Alpine.start();

// Inisialisasi AOS setelah DOM siap
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        // Opsional: Pengaturan global untuk AOS
        duration: 1000, // durasi animasi dalam ms
        once: true,    // apakah animasi hanya berjalan sekali saat scroll ke bawah
    });
});
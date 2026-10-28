# AI Usage Log - Pertemuan 9

## Tujuan
Seluruh panduan dan kode praktikum berasal dari modul yang diberikan dosen.
AI hanya dipakai untuk menjelaskan bagian yang kurang saya pahami dan
membantu mencari solusi ketika terjadi error.

## Prompt penting
- Meminta penjelasan langkah praktikum agar lebih mudah dipahami.
- Menanyakan penyebab error "npm : File npm.ps1 cannot be loaded because running scripts is disabled".
- Menanyakan penyebab error "View [layouts.app] not found".
- Menanyakan arti error "Failed to resolve import './bootstrap'".
- Menanyakan cara menguji route JSON langsung di browser dan cara membaca tab Network di DevTools.
- Menanyakan cara memulihkan tampilan Pertemuan 7 yang tertimpa saat mengganti isi home.blade.php.

## Verifikasi
- Menjalankan 10 test case pada test-matrix.md.
- Console: typeof window.jQuery menghasilkan 'function' dan tidak ada error.
- Network: GET /courses/2/availability, status 200, response JSON.
- Nama di form tetap ada saat pilihan kursus diganti, sehingga terbukti tanpa reload.
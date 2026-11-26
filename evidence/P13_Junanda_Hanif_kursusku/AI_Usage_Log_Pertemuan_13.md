# AI Usage Log: Pertemuan 13 (Pagination, Searching, Filter Status & Draft Artikel Ilmiah)

**Mata kuliah:** Bahasa Pemrograman III (PHP & MySQL)
**Nama:** Junanda Hanif
**NIM:** 2524095
**Project:** KursusKu (Laravel + MySQL Laragon)
**Tanggal:** 26 November 2026

## Cara saya memakai AI

AI saya pakai sebagai pair programmer: membaca error, memeriksa kode yang saya kirim, dan menyusun kerangka dokumen. Setiap saran saya jalankan sendiri lalu saya cek hasilnya di browser, terminal, atau DevTools. Data yang dikirim hanya kode project dan data dummy, tanpa password atau data pribadi.

## Log penggunaan

| # | Prompt / masalah | Saran AI | Diterima / ditolak | Alasan & test |
|---|---|---|---|---|
| 1 | Checkpoint Git gagal: muncul "nothing to commit, working tree clean", dan perintah `clean` yang saya ketik menghasilkan error merah. | Itu bukan kegagalan: tidak ada perubahan yang belum di-commit. Error `clean` hanya karena kata itu terketik sebagai perintah. Commit terakhir yang sudah di-push menjadi titik aman. | Diterima | `git status` menampilkan "Your branch is up to date with 'origin/main'". Saya lanjut tanpa commit tambahan. |
| 2 | Data course belum cukup untuk uji pagination (panduan meminta minimal 21 data, status open/closed/draft). | Tambah 16 data dummy lewat Tinker dengan perulangan, dengan status bergantian open/closed/draft. | Diterima | Halaman daftar menampilkan "Showing 1 to 10 of 24 results". Dummy tidak mengubah skema database. |
| 3 | Mengubah `CourseController@index` agar mendukung search, filter status, dan pagination. | Method `index(Request $request)` dengan `when()` untuk `q` dan `status`, daftar `allowedStatuses`, `orderBy('name')`, `paginate(10)`, dan `withQueryString()`. | Diterima | Halaman hanya menampilkan 10 data dan urutan berdasarkan nama. Method CRUD lain tidak berubah. |
| 4 | Form search dan tombol halaman belum muncul di `/courses`, padahal controller sudah diubah. | AI memeriksa kode view saya dan menemukan `index.blade.php` masih versi lama (belum ada form, empty state baru, dan `links()`). AI memberi isi file lengkap. | Diterima | Setelah saya ganti dan simpan, kotak search, dropdown status, tombol Cari/Reset, dan pagination tampil. |
| 5 | Tampilan tombol pagination perlu sesuai Bootstrap. | Tambahkan `Paginator::useBootstrapFive();` di `boot()` pada `AppServiceProvider`. | Diterima | Pagination tampil rapi dengan halaman 1, 2, 3. |
| 6 | Mengerjakan partial view (Langkah 8 dan 9). `?partial=1` belum menghasilkan potongan tabel. | AI menemukan blok `if ($request->boolean('partial'))` belum ada di controller, lalu menyarankan menaruhnya sebelum `return view('courses.index', ...)`. | Diterima | `/courses?q=dummy&status=open&partial=1` hanya menampilkan tabel hasil (5 kursus Open) tanpa navbar dan form. Saya juga sempat salah mengetik titik di akhir URL (`partial=1.`), sehingga halaman penuh yang tampil. |
| 7 | Menambah live search jQuery. Saya tidak yakin jQuery sudah dimuat karena layout memakai Vite. | Cek `typeof jQuery` di Console (hasilnya `function`), tambah `@stack('scripts')` di layout, dan bungkus script dengan `DOMContentLoaded` karena Vite memuat `app.js` sebagai module. Debounce 300 ms, filter, dan klik pagination ditangani dengan delegated event. | Diterima | Uji dengan tab Network: [isi hasil uji Anda, misalnya request `partial=1` berstatus 200 dan tabel berubah tanpa reload]. Form GET dan tombol Cari tetap ada sebagai fallback. |
| 8 | Saya bertanya apakah langkah-langkahnya sudah sesuai urutan modul. | AI mengakui telah menyebut Langkah 12 sebelum Langkah 6 dan 7 diuji, lalu memberi tabel status per langkah dan urutan yang benar. | Diterima | Saya kembali mengerjakan urutan: empty state, uji tanpa JavaScript, test matrix, lalu Ajax. |
| 9 | Membuat test matrix. | AI menyusun 15 skenario (5 skenario wajib, uji filter, uji tanpa JavaScript) dengan kolom Expected. Kolom Actual dan Status sengaja dikosongkan. | Diterima dengan modifikasi | Kolom Actual dan Status saya isi sendiri setelah menguji di browser. Saya menanyakan apakah kolom Actual wajib. AI menjelaskan panduan memintanya agar Pass punya dasar. |
| 10 | Menyusun artikel ilmiah. Saya memiliki contoh artikel orang lain sebagai referensi struktur. | AI menulis artikel baru dari project dan data saya sendiri, tidak menyalin teks contoh, dan menandai bagian yang harus saya isi (hasil uji, email, referensi jurnal). | Diterima dengan modifikasi | Tabel hasil uji, abstrak, kesimpulan, dan referensi jurnal saya isi sendiri. AI tidak membuat referensi yang tidak bisa diverifikasi. |

## Hal yang saya pelajari (refleksi singkat)

1. Search dan filter memakai metode GET karena tidak mengubah data, sehingga URL bisa disalin dan diuji ulang.
2. `withQueryString()` menjaga keyword dan status saat pindah halaman. Tanpanya, parameter hilang di halaman 2.
3. Filter status hanya diterapkan jika nilainya ada di daftar yang diizinkan. Jika diterapkan saat kosong, hasilnya salah menjadi 0 data.
4. Ajax hanya peningkatan kenyamanan. Fungsi dasar harus tetap bekerja lewat form GET ketika JavaScript mati.
5. Perubahan di controller tidak terlihat jika view belum disimpan. Saya belajar memeriksa file satu per satu dan membaca hasil di browser, bukan hanya menyalin kode.

## Kesiapan code defense

- **Jika JavaScript dimatikan, apakah pencarian masih bekerja?** Ya, karena pencarian memakai form GET dan pagination memakai tautan biasa.
- **Apa akibat menghapus `withQueryString()`?** Keyword dan filter hilang saat pindah halaman.
- **Mengapa filter status tidak boleh diterapkan saat kosong?** Karena akan memfilter `status = ''` dan menghasilkan 0 data.
- **Data apa yang saya ukur untuk artikel?** Hasil 13 skenario uji fungsional pada 24 data kursus. Saya tidak mengukur performa atau waktu respons.

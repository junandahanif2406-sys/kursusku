# AI Usage Log: Pertemuan 12 (Relasi Database KursusKu)

**Mata kuliah:** Bahasa Pemrograman III (PHP & MySQL)
**Project:** KursusKu (Laravel + MySQL Laragon)
**Nama / NIM:** Junanda Hanif / 2524095
**Tanggal:** 18 November 2026

## Cara saya memakai AI

AI saya pakai sebagai pair programmer untuk membaca error dan memeriksa langkah, bukan untuk menggantikan pemahaman. Setiap saran saya jalankan sendiri, lalu saya cek hasilnya di terminal, browser, atau phpMyAdmin. Data yang dikirim hanya kode project dan data dummy (`example.test`), tanpa password atau data pribadi.

## Log penggunaan

| # | Prompt / masalah | Saran AI | Diterima / ditolak | Alasan & test |
|---|---|---|---|---|
| 1 | Bingung cara membuktikan foreign key setelah `php artisan migrate`. Halaman Structure hanya menampilkan indexes. | Buka **Relation view** di phpMyAdmin (atau `SHOW CREATE TABLE enrollments;`) dan cek ON DELETE. | Diterima | Relation view menampilkan `course_id` → `courses.id` dan `participant_id` → `participants.id`, keduanya ON DELETE CASCADE. `migrate:status` menampilkan Ran. |
| 2 | Bingung mengisi model `Enrollment` dan menambah relasi di `Course`. | Isi `Enrollment` dengan `belongsTo` ke Participant dan Course. Tambahkan `hasMany` dan `belongsToMany` di `Course` tanpa menghapus `$fillable`/`$casts`. | Diterima | Tinker: `Participant::first()->enrollments` mengembalikan Collection berisi enrollment id 1. |
| 3 | `Course::find(5)->enrollments` hasilnya `null`. | Awalnya AI menduga tabel courses kosong, lalu **meralat** setelah melihat hasil `Course::all()` (ada 8 course). Penyebab sebenarnya relasi di `Course.php` belum terbaca. | Diterima | Setelah koreksi, saya cek isi `Course.php` dan menemukan masalah di masalah #4. |
| 4 | Tinker menampilkan `ParseError: Unclosed '{' on line 10` di `Course.php`. | Kurung kurawal penutup method `participants()` hilang. Tambahkan satu `}`, simpan, lalu `exit` dan buka Tinker ulang. | Diterima | Setelah diperbaiki, `Course::find(5)->enrollments` mengembalikan enrollment id 1 (participant 1, course 5). Saya paham Tinker tidak memuat ulang file yang diubah saat sesi masih berjalan. |
| 5 | Error `Duplicate entry` saat membuat participant dummy Alya, Bima, dan Citra. | Itu bukan kerusakan: data sudah ada, dan unique email bekerja. Cukup cek `Participant::all()`. | Diterima (tidak ada perubahan kode) | `Participant::all()` menampilkan 3 participant (id 1, 2, 3). Ini sekaligus bukti unique email aktif. |
| 6 | `routes/web.php` lama punya route `/pendaftaran` bernama `enrollments.create`, bentrok dengan `Route::resource('enrollments')`. | Hapus route latihan lama (`/pendaftaran` dan `/pendaftaran/preview`) dan pakai `Route::resource(...)->only(['index','create','store'])`. | Diterima | `php artisan route:list` menampilkan `enrollments.index`, `.create`, `.store` masing-masing satu kali. |
| 7 | Form create dari panduan perlu disesuaikan dengan layout project. | Pertahankan `@extends('layouts.app')` dengan Bootstrap. Buat `index.blade.php` dengan gaya yang sama dan format tanggal `start_date` memakai cast `date` di `Course`. | Diterima | Halaman `/enrollments/create` dan `/enrollments` tampil sesuai layout project. |
| 8 | Dropdown Course kosong di `/enrollments/create`. | Cek `Course::pluck('status','id')`. Controller memfilter `'active'`, sedangkan data memakai `open` dan `draft`. Ada dua pilihan: (A) ubah filter ke `'open'`, (B) ubah semua data ke `active`. | **A diterima, B ditolak** | B ditolak karena akan mengubah data dan merusak fitur CRUD Course yang sudah memakai `open`/`draft`. Setelah filter diubah ke `'open'`, dropdown terisi (course draft tidak tampil, sesuai tujuan). |
| 9 | Menyiapkan data dummy untuk cascade test. | Pakai status course `'open'` (bukan `'active'` seperti di panduan) agar konsisten dengan data project. | Diterima | Cascade course: hasil `1, true, 0, true`. Enrollment ikut terhapus, participant tetap ada. |

## Hal yang saya pelajari (refleksi singkat)

1. Foreign key dengan `cascadeOnDelete()` menjaga integritas: enrollment otomatis terhapus saat induknya dihapus, tetapi entitas lain tidak ikut terhapus.
2. Unique harus pada **pasangan** `participant_id` + `course_id`, bukan masing-masing kolom. Validasi Laravel memberi pesan yang ramah, unique index database menjadi proteksi terakhir.
3. Output `null` atau error tidak selalu berarti kode salah. Saya harus membaca pesan error, mengecek file dan baris, lalu menguji ulang. AI pernah salah menduga (#3) dan saya yang memverifikasi lewat data nyata.
4. Panduan bisa berbeda dengan data project (contoh: status `active` vs `open`), jadi nilai di database harus selalu dicek, bukan langsung disalin.

## Kesiapan code defense

- **Foreign key:** `participant_id` memakai `constrained()->cascadeOnDelete()`, jadi hanya bisa menunjuk participant yang ada dan ikut terhapus jika participant dihapus.
- **Relation method:** `Enrollment::participant()` memakai `belongsTo` karena satu enrollment milik satu participant.
- **Validation rule:** `Rule::unique('enrollments')->where(...)` mencegah participant yang sama mendaftar dua kali ke course yang sama.

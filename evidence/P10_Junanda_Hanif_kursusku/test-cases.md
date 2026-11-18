# Test Case Manual - Pertemuan 10 (CRUD Course: Create + Read)

Nama:Junanda Hanif
NIM:2524095
Tanggal uji: 05/11/2026

## Tabel Pengujian

| No | Skenario | Input utama | Hasil yang diharapkan | Hasil aktual | Status | Evidence |
|----|----------|-------------|-----------------------|--------------|--------|----------|
| 1 | Simpan data valid | PHP-101, PHP Fundamental, 400000, 25, tanggal valid, open | Data tersimpan, redirect ke index, pesan sukses tampil | | [ ] Lulus / [ ] Gagal | 04-index-8-data.png |
| 2 | Kode kosong | code dikosongkan | Validasi gagal, data tidak tersimpan | | [ ] Lulus / [ ] Gagal | 05-validation-error.png |
| 3 | Kode duplikat | WEB-101 dimasukkan kedua kali | Ditolak oleh rule unique | | [ ] Lulus / [ ] Gagal | |
| 4 | Nama kosong | name dikosongkan | Validasi gagal | | [ ] Lulus / [ ] Gagal | |
| 5 | Biaya negatif | fee = -1000 | Ditolak karena min:0 | | [ ] Lulus / [ ] Gagal | |
| 6 | Kuota 0 | quota = 0 | Ditolak karena min:1 | | [ ] Lulus / [ ] Gagal | |
| 7 | Status tidak valid | value status diubah manual menjadi `active` | Ditolak karena hanya draft/open/closed | | [ ] Lulus / [ ] Gagal | |
| 8 | Daftar tampil ulang | Reload (F5) halaman /courses | Data tetap ada karena berasal dari MySQL | | [ ] Lulus / [ ] Gagal | |

## Catatan Perbaikan (isi jika ada test yang Gagal)

| No test | Masalah | Penyebab | Perbaikan |
|---------|---------|----------|-----------|
| | | | |

## Cara Uji Singkat

- Test 2 sampai 7: tambahkan `novalidate` pada tag `<form>` di `courses/create.blade.php` agar yang menolak adalah validasi Laravel, bukan browser.
- Test 7: klik kanan dropdown Status, Inspect, ubah `value="draft"` menjadi `value="active"`, pilih opsi itu, lalu Simpan.
- Test 1 dan 8: cek juga baris data di tabel `courses` pada phpMyAdmin.

## Penjelasan Jalur Request (isi dengan kalimat sendiri)

Browser (form) -> Route `courses.store` -> Controller `store()` -> validasi -> Model `Course::create()` -> MySQL tabel `courses` -> redirect ke `courses.index`.

Penjelasan saya:

____________________________________________________________
____________________________________________________________

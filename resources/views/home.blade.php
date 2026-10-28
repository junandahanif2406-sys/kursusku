@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')
{{-- Hero: teks kiri, gambar kanan --}}
<section class="py-4">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <span class="badge text-bg-success mb-3">
                Kursus teknologi untuk mahasiswa
            </span>
            <h1 class="display-5 fw-bold">
                Belajar lebih terarah bersama KursusKu
            </h1>
            <p class="lead text-secondary">
                Pilih kursus, cek ketersediaan kursi, lalu isi formulir pendaftaran.
            </p>
            <a href="{{ route('enrollments.create') }}" class="btn btn-success">
                Daftar Kursus
            </a>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('images/hero.jpg') }}"
                 alt="Belajar di KursusKu"
                 class="img-fluid rounded shadow-sm w-100"
                 style="max-height: 340px; object-fit: cover;">
        </div>
    </div>
</section>
@endsection
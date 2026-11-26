@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
{{-- Hero --}}
<section class="py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <p class="text-muted mb-2">Belajar Web Secara Bertahap</p>
            <h1 class="display-5 fw-bold">Bangun kemampuan web dari PHP sampai Laravel.</h1>
            <p class="lead text-secondary">Kursusku menyediakan latihan terarah untuk pemula.</p>
            <a href="{{ route('courses.index') }}" class="btn btn-success">Daftar Kursus</a>
        </div>
        <div class="col-lg-5">
            <img src="{{ asset('images/hero.jpg') }}" alt="Belajar di KursusKu"
                 class="img-fluid rounded-4 w-100" style="max-height: 300px; object-fit: cover;">
        </div>
    </div>
</section>

{{-- Kursus Pilihan --}}
@php
    $featured = [
        ['code' => 'WEB-01', 'name' => 'Web Dasar',           'desc' => 'Belajar struktur HTML dan CSS dasar.'],
        ['code' => 'PHP-01', 'name' => 'PHP Dasar',           'desc' => 'Belajar variabel, function, form, dan logika PHP.'],
        ['code' => 'LAR-01', 'name' => 'Laravel Fundamental', 'desc' => 'Belajar route, controller, Blade, dan MVC.'],
        ['code' => 'UI-01',  'name' => 'UI Web Dasar',        'desc' => 'Belajar prinsip tampilan web yang rapi.'],
    ];
@endphp

<section class="py-4">
    <h2 class="h4 fw-bold mb-3">Kursus Pilihan</h2>
    <div class="row g-3">
        @foreach ($featured as $c)
            <div class="col-md-6 col-lg-3">
                <div class="card course-card h-100 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <small class="text-muted">{{ $c['code'] }}</small>
                        <h5 class="card-title fw-bold mt-2">{{ $c['name'] }}</h5>
                        <p class="card-text text-secondary">{{ $c['desc'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
@push('scripts')
<script>
    document.querySelectorAll('.course-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.course-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
        });
    });
</script>
@endpush
@extends('layouts.app')

@section('title', 'Daftar Kursus')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1">Daftar Kursus</h1>
            <p class="text-muted mb-0">Data diambil dari MySQL melalui Eloquent.</p>
        </div>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            + Tambah Kursus
        </a>
    </div>

    <form method="GET" action="{{ route('courses.index') }}" class="row g-2 mb-3">
        <div class="col-md-6">
            <input type="search" id="live-search" name="q" value="{{ $search }}"
                   class="form-control" placeholder="Cari kode atau nama kursus">
        </div>
        <div class="col-md-3">
            <select name="status" id="status-filter" class="form-select">
                <option value="">Semua status</option>
                <option value="open" @selected($status === 'open')>Open</option>
                <option value="closed" @selected($status === 'closed')>Closed</option>
                <option value="draft" @selected($status === 'draft')>Draft</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary">Cari</button>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    @include('courses._results')

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let searchTimer;

    function loadCourses(url) {
        $.get(url)
            .done(function (html) {
                $('#course-results').replaceWith(html);
            })
            .fail(function () {
                console.error('Gagal memuat hasil course.');
            });
    }

    function searchUrl() {
        const u = new URL('{{ route('courses.index') }}');
        u.searchParams.set('q', $('#live-search').val());
        u.searchParams.set('status', $('#status-filter').val());
        u.searchParams.set('partial', '1');
        return u.toString();
    }

    // Langkah 10: live search, debounce 300 ms
    $(document).on('input', '#live-search', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () {
            loadCourses(searchUrl());
        }, 300);
    });

    $(document).on('change', '#status-filter', function () {
        loadCourses(searchUrl());
    });

    // Langkah 11: pagination via Ajax
    $(document).on('click', '#course-results .pagination a', function (e) {
        e.preventDefault();
        const u = new URL($(this).attr('href'), window.location.origin);
        u.searchParams.set('partial', '1');
        loadCourses(u.toString());
    });
});
</script>
@endpush
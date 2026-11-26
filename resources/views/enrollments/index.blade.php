@extends('layouts.app')

@section('title', 'Laporan Enrollment')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Laporan Enrollment KursusKu</h1>
        <a class="btn btn-primary" href="{{ route('enrollments.create') }}">Tambah Enrollment</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>Participant</th>
                    <th>Course</th>
                    <th>Start Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->participant->name }}</td>
                        <td>{{ $enrollment->course->name }}</td>
                        <td>{{ $enrollment->course->start_date?->format('d M Y') }}</td>
                        <td>{{ $enrollment->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Belum ada enrollment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
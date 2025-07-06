@extends('layouts.app_layout')
@section('title', 'Campus Leaks - Riwayat Laporan')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg mx-auto mt-3 mt-md-5" style="max-width: 900px;">
        <div class="card-body bg-light rounded p-4 p-md-5">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @auth
                @if($reports->isEmpty())
                    <div class="text-center mt-4">
                        <p class="text-secondary">📭 Belum ada laporan yang Anda kirimkan.</p>
                    </div>
                @else
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">📄 Riwayat Laporan Anda</h2>
                        <p class="text-muted">Berikut adalah daftar laporan dan aspirasi yang telah Anda kirimkan.</p>
                    </div>

                    @foreach($reports as $report)
                        <div class="card mb-3 border-0 shadow-sm" style="background-color: #31363F; color: #f1f1f1;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-2">📌 {{ $report->judul }}</h5>

                                <div class="mb-2">
                                    <strong>📝 Deskripsi:</strong> {{ $report->deskripsi }}
                                </div>
                                <div class="mb-2">
                                    <strong>📍 Lokasi:</strong> {{ $report->lokasi }}
                                </div>
                                <div class="mb-2">
                                    <strong>🏫 Jurusan:</strong> {{ $report->jurusan }}
                                </div>

                                @php
                                    $kategori = json_decode($report->kategori, true);
                                    $kategoriText = is_array($kategori) ? implode(', ', $kategori) : $report->kategori;
                                @endphp
                                <div class="mb-2">
                                    <strong>🏷️ Kategori:</strong> {{ $kategoriText }}
                                </div>

                                <div class="mb-2">
                                    <strong>📊 Status:</strong>
                                    @switch($report->status)
                                        @case('Diproses')
                                            <span class="badge bg-primary">Diproses</span>
                                            @break
                                        @case('Selesai')
                                            <span class="badge bg-success">Selesai</span>
                                            @break
                                        @case('Diterima')
                                            <span class="badge bg-info text-dark">Diterima</span>
                                            @break
                                        @case('Ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                            @break
                                        @default
                                            <span class="badge bg-warning text-dark">Belum Diproses</span>
                                    @endswitch
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                                    <a href="{{ route('riwayat.detail', $report->id) }}" class="btn btn-outline-primary btn-sm mb-2 mb-md-0">
                                        🔍 Lihat Detail
                                    </a>
                                    <small class="text-muted">🕒 {{ $report->created_at->format('d M Y, H:i') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endauth

            @guest
                <div class="text-center mt-4">
                    <p class="text-muted">
                        Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk melihat riwayat laporan Anda.
                    </p>
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection

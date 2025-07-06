@extends('layouts.app_Layout')

@section('title', 'Campus Leaks_Report')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg mx-auto mt-3 mt-md-5" style="max-width: 900px;">
        <div class="card-body p-5 bg-light rounded">
            <h2 class="text-center fw-bold mb-4 text-primary">📝 Form Laporan & Aspirasi Mahasiswa</h2>
            <hr>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @auth
            <form method="POST" action="{{ route('report.send') }}" enctype="multipart/form-data">
                @csrf

                <h5 class="mb-3">📌 Data Pelapor</h5>
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul Laporan</label>
                    <input type="text" name="laporan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori Isu</label>
                    <div class="row">
                        @php
                            $kategoriList = [
                                "Kehidupan Kampus", "Akademik", "Fasilitas Kampus/Publik",
                                "Lingkungan", "Sosial Budaya", "Kebijakan/Pemerintahan"
                            ];
                        @endphp
                        @foreach($kategoriList as $kategori)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kategori[]" value="{{ $kategori }}">
                                    <label class="form-check-label">{{ $kategori }}</label>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 mt-2 d-flex align-items-center gap-2">
                            <input class="form-check-input" type="checkbox" name="kategori[]" value="Yang Lain">
                            <span class="me-2">Yang Lain:</span>
                            <input type="text" name="kategori_lain" class="form-control" placeholder="Sebutkan" style="max-width: 300px;">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Isu atau Aspirasi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tulis deskripsi singkat" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi atau Situasi Terkait</label>
                    <textarea name="lokasi" class="form-control" rows="3" placeholder="Contoh: Gedung B, Lantai 2, dll." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">📎 Bukti Pendukung</label>
                    <input type="file" name="bukti[]" class="form-control" multiple>
                    <small class="text-muted">Maksimal 5 file, masing-masing maks. 100MB</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hubungan Anda dengan Isu</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hubungan" value="Saya langsung terdampak" required>
                        <label class="form-check-label">Saya langsung terdampak</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hubungan" value="Saya mengetahui dari orang lain" required>
                        <label class="form-check-label">Saya mengetahui dari orang lain</label>
                    </div>
                    <div class="form-check d-flex align-items-center gap-2 mt-2">
                        <input class="form-check-input" type="radio" name="hubungan" value="Yang lain" required>
                        <input type="text" name="hubungan_lain" class="form-control" placeholder="Sebutkan..." style="max-width: 300px;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Preferensi Kerahasiaan Identitas</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="identitas" value="Rahasia" required>
                        <label class="form-check-label">Saya ingin identitas dirahasiakan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="identitas" value="Terbuka" required>
                        <label class="form-check-label">Saya tidak keberatan jika identitas saya diketahui</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm">🚀 Kirim Laporan</button>
                </div>
            </form>
            @endauth

            @guest
                <div class="text-center mt-3">
                    <p class="text-muted">Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk mengirim laporan.</p>
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection

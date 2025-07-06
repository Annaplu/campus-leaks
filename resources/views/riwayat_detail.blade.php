<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Detail Laporan Anda</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <h4>{{ $report->judul }}</h4>
            <p><strong>Deskripsi:</strong> {{ $report->deskripsi }}</p>
            <p><strong>Lokasi:</strong> {{ $report->lokasi }}</p>
            <p><strong>Jurusan:</strong> {{ $report->jurusan }}</p>

            @php
                $kategori = json_decode($report->kategori, true);
                $kategoriText = is_array($kategori) ? implode(', ', $kategori) : $report->kategori;
            @endphp
            <p><strong>Kategori:</strong> {{ $kategoriText }}</p>

            <p class="mb-1"><strong>Status:</strong>
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
            @if($report->komentar)
                    <p class="mt-2"><strong>Pesan dari PERSMA:</strong> {{ $report->komentar }}</p>
                @endif
            </p>
            

            @if($report->bukti)
                @php
                    $buktiFiles = json_decode($report->bukti, true);
                @endphp

                <div class="mt-3">
                    <p><strong>Bukti:</strong></p>
                    <div class="row">
                        @foreach ($buktiFiles as $file)
                            @php
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            @endphp

                            @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                <div class="col-md-4 mb-3">
                                    <img src="{{ asset('storage/' . $file) }}" alt="Bukti Gambar" class="img-fluid rounded shadow-sm">
                                </div>
                            @elseif (in_array($ext, ['mp4', 'mov', 'avi']))
                                <div class="col-md-6 mb-3">
                                    <video controls class="w-100 rounded shadow-sm">
                                        <source src="{{ asset('storage/' . $file) }}" type="video/{{ $ext }}">
                                        Browser Anda tidak mendukung video.
                                    </video>
                                </div>
                            @else
                                <div class="col-md-12 mb-2">
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Lihat File Bukti ({{ strtoupper($ext) }})
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            

            <p><small class="text-muted">Dikirim pada: {{ $report->created_at->format('d M Y, H:i') }}</small></p>
            <a href="{{ route('riwayat') }}" class="btn btn-secondary mt-3">Kembali ke Riwayat</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

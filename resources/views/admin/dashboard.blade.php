<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>

  <link rel="stylesheet" href="{{ asset('css/informasiadmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/indexadmin.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .info-box {
      padding: 20px;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      text-decoration: none;
      transition: all 0.25s ease-in-out;
      color: inherit;
    }

    .info-box:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      background-color: #f9f9f9;
    }

    .info-icon {
      font-size: 26px;
      background-color: rgba(0, 0, 0, 0.05);
      width: 52px;
      height: 52px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
    }

    .card-header {
      background-color: #fff;
      font-weight: 600;
      font-size: 1.05rem;
      border-bottom: 1px solid #e5e5e5;
    }

    .table td, .table th {
      padding: 14px 16px;
      vertical-align: middle;
    }

    .table thead th {
      font-weight: 600;
      background-color: #f8f9fa;
      border-bottom: 2px solid #dee2e6;
    }

    .table-bordered > :not(caption) > * > * {
      border-width: 1px;
    }

    .badge {
      font-size: 0.85rem;
      padding: 6px 12px;
      border-radius: 20px;
    }

    .badge.bg-success {
      background-color: #198754 !important;
    }

    .badge.bg-warning {
      background-color: #ffc107 !important;
      color: #212529;
    }

    .badge.bg-danger {
      background-color: #dc3545 !important;
    }

    .highlight-berita {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .highlight-berita-item {
      padding: 12px;
      background-color: #f8f9fa;
      border-radius: 8px;
    }

    .highlight-berita-item h6 {
      margin-bottom: 6px;
      font-size: 1rem;
      font-weight: 600;
    }

    .dashboard-wrapper {
      margin-bottom: 80px; /* Jarak dari konten ke footer */
    }
  </style>
</head>
<body class="bg-light" style="padding-top: 120px;">

  @include('components.headerAdmin')
  @stack('styles')
  @stack('scripts')

  <div class="container-fluid dashboard-wrapper">
    <div class="container">
      <h2 class="fw-bold mb-4">Selamat Datang, Tuan Admin 👋</h2>
      <div class="row">

        <!-- Info Boxes -->
        <div class="col-lg-8">
          <div class="row g-3">
            <div class="col-md-6">
              <a href="{{ route('admin.informasi', ['status' => 'menunggu']) }}" class="info-box d-flex align-items-center gap-3">
                <div class="info-icon text-danger">🕒</div>
                <div>
                  <h5 class="mb-0">{{ $jumlahMenunggu }}</h5>
                  <small class="text-muted">Laporan belum diproses</small>
                </div>
              </a>
            </div>
            <div class="col-md-6">
              <a href="{{ route('admin.informasi') }}" class="info-box d-flex align-items-center gap-3">
                <div class="info-icon text-primary">📥</div>
                <div>
                  <h5 class="mb-0">{{ $laporan->count() }}</h5>
                  <small class="text-muted">Total laporan masuk</small>
                </div>
              </a>
            </div>
            <div class="col-md-6">
              <a href="{{ route('admin.informasi', ['status' => 'selesai']) }}" class="info-box d-flex align-items-center gap-3">
                <div class="info-icon text-success">✅</div>
                <div>
                  <h5 class="mb-0">{{ $jumlahSelesai }}</h5>
                  <small class="text-muted">Laporan selesai</small>
                </div>
              </a>
            </div>
            <div class="col-md-6">
              <a href="{{ route('admin.pengguna') }}" class="info-box d-flex align-items-center gap-3">
                <div class="info-icon text-warning">👥</div>
                <div>
                  <h5 class="mb-0">{{ $totalPengguna }}</h5>
                  <small class="text-muted">Total pengguna</small>
                </div>
              </a>
            </div>
          </div>

          <!-- Tabel Laporan -->
          <div class="card mt-4">
            <div class="card-header">Daftar Laporan</div>
            <div class="table-responsive">
              <table class="table table-hover align-middle table-bordered mb-0">
                <thead class="table-light text-center">
                  <tr>
                    <th style="width: 30%;">Judul</th>
                    <th style="width: 20%;">Kategori</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 25%;">Tanggal Masuk</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @forelse($laporan as $item)
                  <tr>
                    <td class="text-start fw-semibold">{{ $item->judul }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>
                      <span class="badge bg-{{ 
                        $item->status == 'Selesai' ? 'success' : 
                        ($item->status == 'Diproses' ? 'warning' : 'danger') }}">
                        {{ $item->status }}
                      </span>
                    </td>
                    <td>
                      <small class="text-muted">
                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                      </small>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="text-center text-muted py-3">Tidak ada laporan yang ditemukan.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Highlights -->
        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="card">
            <div class="card-header">Highlights Terbaru</div>
            <div class="card-body">
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif

              <form action="{{ route('admin.ambil_berita') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary w-100">Ambil Berita</button>
              </form>

              <div class="highlight-berita" style="max-height: 400px; overflow-y: auto;">
                @forelse($berita as $item)
                  <div class="highlight-berita-item">
                    <h6>{{ $item->judul }}</h6>
                    <form action="{{ route('admin.toggle_banner', $item->id) }}" method="POST">
                      @csrf
                      @method('PATCH')
                      <button class="btn btn-sm {{ $item->is_banner ? 'btn-success' : 'btn-outline-secondary' }}">
                        {{ $item->is_banner ? 'Tampil di Banner' : 'Tidak Tampil di Banner' }}
                      </button>
                    </form>
                  </div>
                @empty
                  <p class="text-muted">Belum ada berita terbaru.</p>
                @endforelse
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  @include('components.footerAdmin')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
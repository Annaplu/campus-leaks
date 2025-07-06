<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/informasiadmin.css') }}">
  <title>Informasi Laporan</title>

  <!-- Gunakan Tailwind jika tersedia -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  @include('components.headerAdmin')
    @stack('styles')

    @stack('scripts')

  <div class="container mx-auto px-4 py-6 pt-[120px]">
    <h2 class="text-2xl font-bold mb-4">📢 Informasi Laporan</h2>

    <!-- Filter Status -->
    <form method="GET" action="{{ route('admin.informasi') }}" class="mb-6 flex items-center gap-3">
      <label for="status" class="font-medium">Filter Status:</label>
      <select name="status" id="status" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm">
          <option value="">-- Semua --</option>
          <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Belum Diproses</option>
          <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
          <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
      </select>
    </form>

    @if(request('status'))
      <div class="mb-4 text-sm text-gray-700">
        Menampilkan laporan dengan status: 
        <span class="font-semibold">{{ request('status') }}</span>
      </div>
    @endif

    <!-- Tabel Laporan -->
    <div class="overflow-x-auto shadow rounded-lg">
      <table class="min-w-full bg-white text-sm">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="p-3 text-left">📌</th>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Kategori</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Tanggal Masuk</th>
            <th class="p-3 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($laporan as $lapor)
          <tr class="border-b hover:bg-gray-50">
            <td class="p-3">
              <input type="checkbox" name="laporan_id[]" value="{{ $lapor->id }}">
            </td>
            <td class="p-3">{{ $lapor->judul }}</td>
            <td class="p-3">{{ $lapor->kategori }}</td>
            <td class="p-3">
              <span class="
                px-2 py-1 rounded-full text-white text-xs
                {{ $lapor->status == 'Selesai' ? 'bg-green-500' : ($lapor->status == 'Diproses' ? 'bg-yellow-500' : 'bg-red-500') }}">
                {{ $lapor->status }}
              </span>
            </td>
            <td class="p-3">{{ $lapor->tanggal_masuk->format('d-m-Y') }}</td>
            <td class="p-3">
              <a href="{{ route('admin.laporan.detail', $lapor->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-medium">
                Lihat Detail
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">Belum ada laporan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@include('components.footerAdmin')

  <script src="{{ asset('js/informasiadmin.js') }}"></script>
</body>
</html>

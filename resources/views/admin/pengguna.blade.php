<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('css/informasiadmin.css') }}">
  
  <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">
  <title>Daftar Pengguna</title>
</head>
<body style="min-height: 100vh; display: flex; flex-direction: column;">

  @include('components.headerAdmin')
    @stack('styles')

    @stack('scripts')
  <main style="flex: 1; padding: 2rem; background-color: #f4f6f8; padding-top: 130px;">
    <section class="search-section" style="max-width: 1000px; margin: 0 auto 1.5rem;">
      <h2 style="font-size: 1.8rem; font-weight: 600; color: #333; margin-bottom: 1rem;">📋 Daftar Pengguna</h2>

      <form method="GET" action="{{ route('admin.pengguna') }}" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px;">
      
    </form>

    </section>
    <!-- Tabel -->
    <section class="table-section" style="max-width: 1000px; margin: 0 auto;">
      <div style="overflow-x:auto; background: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <table class="main-table" style="width: 100%; border-collapse: collapse;">
          <thead style="background-color: #f1f1f1;">
            <tr style="text-align: left;">
              <th style="padding: 12px 16px;">Nama</th>
              <th style="padding: 12px 16px;">NIM/NIP</th>
              <th style="padding: 12px 16px;">Tanggal Daftar</th>
              <th style="padding: 12px 16px;">Peran</th>
              <th style="padding: 12px 16px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
            <tr style="border-top: 1px solid #eee;">
              <td style="padding: 12px 16px;">{{ $user->name }}</td>
              <td style="padding: 12px 16px;">{{ $user->identifier }}</td>
              <td style="padding: 12px 16px;">{{ $user->created_at->format('d-m-Y') }}</td>
              <td style="padding: 12px 16px;">{{ ucfirst($user->role) }}</td>
              <td style="padding: 12px 16px;">
                <a href="{{ route('admin.pengguna.edit', $user->id) }}">
                  <button style="background-color: #28a745; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer;">Edit</button>
                </a>
                <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Yakin ingin menghapus pengguna ini?')" style="background-color: red; color: white; padding: 6px 12px; border-radius: 6px; border: none; cursor: pointer;">Hapus</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align: center; padding: 20px; color: #999;">Belum ada pengguna terdaftar.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </section>
  </main>

  @include('components.footerAdmin')

  <script src="{{ asset('js/informasiadmin.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">

  <title>@yield('title', 'Halaman Admin')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/informasiadmin.css') }}">
</head>
<body>
  {{-- Header --}}
  @include('components.headerAdmin')
    @stack('styles')

    @stack('scripts')

  {{-- Konten --}}
  <main class="container mt-3">
    {{-- Notifikasi Flash Message --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    {{-- Tempat isi halaman dimuat --}}
    @yield('content')
  </main>

  @include('components.footerAdmin')

  <script src="{{ asset('js/informasiadmin.js') }}"></script>
</body>
</html>

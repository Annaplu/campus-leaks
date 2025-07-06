@extends('layouts.admin_Layout')

@section('title', 'Detail Laporan')

@section('content')
<div class="container mt-5 pt-5" style="padding-top: 100px;">

    <h2>Detail Laporan</h2>
    <hr>

    <p><strong>Pelapor:</strong> {{ $laporan->user->name ?? 'Tidak diketahui' }}</p>
    <p><strong>Judul:</strong> {{ $laporan->judul }}</p>
    <p><strong>Kategori:</strong> 
        @foreach (json_decode($laporan->kategori, true) as $item)
            <span class="badge bg-info text-dark">{{ $item }}</span>
        @endforeach
    </p>
    <p><strong>Deskripsi:</strong> {{ $laporan->deskripsi }}</p>
    <p><strong>Lokasi:</strong> {{ $laporan->lokasi }}</p>
    <p><strong>Status:</strong> 
        @if ($laporan->status == 'Diterima')
            <span class="badge bg-success">Diterima</span>
        @elseif ($laporan->status == 'Ditolak')
            <span class="badge bg-danger">Ditolak</span>
        @elseif ($laporan->status == 'Diproses')
            <span class="badge bg-warning text-dark">Diproses</span>
        @elseif ($laporan->status == 'Selesai')
            <span class="badge bg-primary">Selesai</span>
        @else
            <span class="badge bg-secondary">Menunggu</span>
        @endif
    </p>

    <p><strong>Komentar Admin:</strong> {{ $laporan->komentar ?? '-' }}</p>

    <p><strong>Bukti:</strong></p>
    @php
        $buktiFiles = json_decode($laporan->bukti, true);
        if (!$buktiFiles) $buktiFiles = [$laporan->bukti];
    @endphp

    @if($buktiFiles && count($buktiFiles) > 0)
        @foreach ($buktiFiles as $file)
            <img src="{{ asset('storage/' . $file) }}" alt="Bukti" style="max-width: 300px; margin: 10px;">
        @endforeach
    @else
        <p>Tidak ada bukti.</p>
    @endif

    <form action="{{ route('admin.laporan.updateStatus', $laporan->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')

        <div class="form-group mb-3">
            <label for="komentar"><strong>Komentar Admin:</strong></label>
            <textarea name="komentar" id="komentar" rows="3" class="form-control" placeholder="Alasan menerima / menolak laporan...">{{ old('komentar', $laporan->komentar) }}</textarea>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <button type="submit" name="status" value="Diproses" class="btn btn-warning text-dark">Tandai Diproses</button>
            <button type="submit" name="status" value="Selesai" class="btn btn-primary">Tandai Selesai</button>
            <button type="submit" name="status" value="Diterima" class="btn btn-success">Terima</button>
            <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Tolak</button>
        </div>
    </form>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3" >Kembali</a>
</div>
@endsection

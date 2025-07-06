@extends('layouts.admin_layout')

@section('content')
<div class="container mt-5 pt-5" style="padding-top: 120px;">

    <h3>Edit Pengguna</h3>

    <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>NIM/NIP</label>
            <input type="text" name="identifier" value="{{ $user->identifier }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Peran</label>
            <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.pengguna') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

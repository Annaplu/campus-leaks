@extends('layouts.app_layout')
@section('title', 'Campus Leaks_Profile')

@section('content')
<style>
    .profile-offset {
        margin-top: 180px; /* Atur sesuai tinggi headermu */
    }

    @media (max-width: 1024px) and (min-width: 768px) {
        .profile-offset {
            margin-top: 130px !important;
        }
    }

    @media (max-width: 767px) {
        .profile-offset {
            margin-top: 100px !important;
        }
    }
</style>

<div class="profile-offset layout_padding py-5">
    <div class="container">
        @if (session('status') == 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profil berhasil diperbarui.
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('status') == 'password-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password berhasil diubah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Edit Profil -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="bg-white p-4 shadow rounded">
                    <h4 class="mb-4 font-weight-bold">Edit Profil</h4>
                    <form method="post" action="{{ route('profile.update') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('patch')

                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Ubah Password -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="bg-white p-4 shadow rounded">
                    <h4 class="mb-4 font-weight-bold">Ubah Password</h4>
                    <form method="post" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group mb-3">
                        <label for="current_password">Password Saat Ini</label>
                        <input id="current_password" type="password" name="current_password" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password Baru</label>
                        <input id="password" type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Ubah Password</button>
                </form>
                </div>
            </div>
        </div>

        <!-- Penghapusan Akun -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white p-4 shadow rounded">
                    <h4 class="text-danger font-weight-bold">Penghapusan Akun</h4>
                    <p class="text-muted">Tekan tombol di bawah jika kamu yakin ingin menghapus akun ini secara permanen.</p>
                    <button class="btn btn-danger mt-3" onclick="showDeleteModal()">Hapus Akun</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow rounded">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus Akun</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body p-4">
                <p class="mb-3 text-muted">Semua data kamu akan dihapus secara permanen. Masukkan password untuk konfirmasi.</p>

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <label for="delete_password">Password</label>
                        <input id="delete_password" name="password" type="password" class="form-control" required placeholder="Masukkan password">
                    </div>

                    <button type="submit" class="btn btn-danger mt-3 w-100">Hapus Akun</button>
                </form>
            </div>

            <div class="modal-footer justify-content-center px-4 pb-4">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Script Modal -->
<script>
    function showDeleteModal() {
        $('#deleteModal').modal('show');
    }
</script>
@endsection

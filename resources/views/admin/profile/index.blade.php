@extends('admin.layout.index')

@section('title', 'Miniseri - Profile Admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- HEADER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="ti ti-user me-2"></i>Profil Saya
                    </h4>
                    <p class="text-muted small mt-2 mb-0">
                        Kelola informasi akun dan keamanan Anda
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.alert')

    <div class="row">

        <!-- EDIT PROFILE -->
        <div class="col-12 col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                placeholder="Masukkan nama lengkap"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                placeholder="Masukkan email"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">
                        
                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                password minimal 6 huruf, angka, atau simbol.
                            </small>
                        </div>

                        <!-- Konfirmasi -->
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <input
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="Ulangi password baru">
                        </div>

                        <!-- ACTION -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">
                                <i class="ti ti-check me-1"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.dashboard.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-12 col-md-4">

            <!-- INFO PROFILE -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Nama</small>
                        <div class="fw-medium">{{ $user->name }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Email</small>
                        <div class="fw-medium">{{ $user->email }}</div>
                    </div>
                    <div>
                        <small class="text-muted">Bergabung Sejak</small>
                        <div class="fw-medium">
                            {{ $user->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- DANGER ZONE -->
            <div class="card border-danger">
                <div class="card-header border-danger">
                    <h5 class="mb-0 text-danger">
                        <i class="ti ti-alert-triangle me-1"></i>Zona Bahaya
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        Menghapus akun akan menghapus seluruh data secara permanen dan tidak dapat dibatalkan.
                    </p>
                    <form
                        action="{{ route('admin.profile.destroy') }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan!')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger w-100">
                            <i class="ti ti-trash me-1"></i>Hapus Akun
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

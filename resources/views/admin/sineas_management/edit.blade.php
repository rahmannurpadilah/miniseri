<!-- Form Edit Sineas -->
@extends('admin.layout.index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Halaman -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.sineas.index') }}" class="btn btn-icon btn-text-secondary rounded-pill me-3">
                    <i class="ti ti-arrow-left"></i>
                </a>

                <!-- Judul -->
                <div>
                    <h4 class="mb-0">Edit Data Sineas</h4>
                    <p class="text-muted small mt-1 mb-0">Perbarui informasi pendaftar sineas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Form Edit -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Form Edit -->
                    <form action="{{ route('admin.sineas.update', Crypt::encrypt($sineas->id)) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label class="form-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                placeholder="Masukkan nama lengkap"
                                value="{{ old('name', $sineas->name) }}"
                                required />
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                placeholder="Masukkan email"
                                value="{{ old('email', $sineas->email) }}"
                                required />
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-4">
                            <label class="form-label" for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="phone"
                                name="phone"
                                placeholder="Masukkan nomor telepon"
                                value="{{ old('phone', $sineas->phone) }}"
                                required />
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bisa Edit -->
                        <div class="mb-4">
                            <label class="form-label" for="can_edit">Bisa Edit <span class="text-danger">*</span></label>
                            <select class="form-select @error('can_edit') is-invalid @enderror" id="can_edit" name="can_edit" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Ya" @if(old('can_edit', $sineas->can_edit) === 'Ya') selected @endif>Ya</option>
                                <option value="Tidak" @if(old('can_edit', $sineas->can_edit) === 'Tidak') selected @endif>Tidak</option>
                            </select>
                            @error('can_edit')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Persetujuan -->
                        {{-- <div class="mb-4">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="agreement"
                                    name="agreement"
                                    value="1"
                                    @if(old('agreement', $sineas->agreement)) checked @endif />
                                <label class="form-check-label" for="agreement">
                                    Setuju dengan syarat dan ketentuan
                                </label>
                            </div>
                            @error('agreement')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 pt-3">
                            <!-- Tombol Simpan -->
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check me-2"></i>Simpan Perubahan
                            </button>

                            <!-- Tombol Batal -->
                            <a href="{{ route('admin.sineas.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-x me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title mb-3">Informasi Lainnya</h6>
                    <div class="row text-sm">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Tanggal Daftar</p>
                            <p class="fw-medium mb-3">{{ $sineas->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Terakhir Diubah</p>
                            <p class="fw-medium mb-3">{{ $sineas->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="ti ti-info-circle me-2"></i>Panduan
                    </h6>
                    <div class="alert alert-info small" role="alert">
                        <strong>Tips:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Pastikan email unik dan valid</li>
                            <li>Nomor telepon harus valid dan aktif</li>
                            <li>Pilih status "Bisa Edit" sesuai dengan hak akses pengguna</li>
                            <li>Centang kotak persetujuan jika pengguna telah setuju dengan syarat dan ketentuan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Tambahan -->
<style>
    .btn-text-secondary {
        color: #6c757d;
        border: none;
        background: transparent;
    }

    .btn-text-secondary:hover {
        color: #495057;
        background-color: rgba(108, 117, 125, 0.1);
    }
</style>
@endsection

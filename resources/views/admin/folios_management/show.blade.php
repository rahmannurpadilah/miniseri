@extends('admin.layout.index')
@section('title', 'Miniseri - Detail Folio')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Detail Folio: {{ $folio->title }}</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.folios.edit', $folio) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="{{ route('admin.folios.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">

        <!-- MAIN CONTENT -->
        <div class="col-lg-8 mb-4">
            <div class="card mb-4">

                <!-- Banner -->
                <div class="position-relative">
                    @if ($folio->banner)
                        <img src="{{ asset('storage/' . $folio->banner) }}"
                             class="card-img-top"
                             style="height: 400px; object-fit: cover;"
                             alt="{{ $folio->title }}">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                             style="height: 400px;">
                            <i class="fas fa-image fa-5x text-muted"></i>
                        </div>
                    @endif

                    <!-- Unggulan Badge -->
                    @if ($folio->is_favorite)
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-warning text-dark p-2">
                                <i class="fas fa-star me-2"></i>Film Unggulan
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ $folio->title }}</h4>

                    <div class="mb-4">
                        <h6 class="mb-2">Deskripsi Singkat</h6>
                        <p class="text-muted">{{ $folio->desc_home }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="mb-2">Deskripsi Sidebar</h6>
                        <p class="text-muted" style="white-space: pre-wrap;">
                            {{ $folio->desc_side }}
                        </p>
                    </div>

                    <div class="mb-0">
                        <h6 class="mb-2">Deskripsi Lengkap</h6>
                        <p class="text-muted" style="white-space: pre-wrap;">
                            {{ $folio->desc_full }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">

            <!-- TRAILER (PINDAH KE ATAS) -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Trailer</h6>
                </div>
                <div class="card-body">
                    @if ($folio->trailer)
                        <video controls class="w-100 rounded" style="max-height: 220px;">
                            <source src="{{ asset('storage/' . $folio->trailer) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    @else
                        <p class="text-muted small mb-0">Tidak ada video trailer</p>
                    @endif
                </div>
            </div>

            <!-- INFO CARD -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Informasi Folio</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="text-muted">ID</td>
                            <td><strong>{{ $folio->id }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td>
                                @if ($folio->is_favorite)
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star me-1"></i>Unggulan
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Regular</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat</td>
                            <td>{{ $folio->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Diperbarui</td>
                            <td>{{ $folio->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- FILE ASSETS -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">File Assets</h6>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Banner</small>
                        @if ($folio->banner)
                            <a href="{{ asset('storage/' . $folio->banner) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                Buka Banner
                            </a>
                        @else
                            <p class="text-muted small mb-0">Tidak ada banner</p>
                        @endif
                    </div>

                    <hr>

                    <div>
                        <small class="text-muted d-block mb-1">Trailer</small>
                        @if ($folio->trailer)
                            <a href="{{ asset('storage/' . $folio->trailer) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                Buka Video
                            </a>
                        @else
                            <p class="text-muted small mb-0">Tidak ada trailer</p>
                        @endif
                    </div>

                </div>
            </div>

            <!-- ACTIONS -->
            <div class="card">
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('admin.folios.edit', $folio) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Folio
                    </a>
                    <button type="button"
                            class="btn btn-danger"
                            onclick="confirmDelete('{{ route('admin.folios.destroy', $folio) }}')">
                        <i class="fas fa-trash me-2"></i>Hapus Folio
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- DELETE FORM -->
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function confirmDelete(url) {
        if (confirm('Apakah Anda yakin ingin menghapus folio ini?\n\nTindakan ini tidak dapat dibatalkan!')) {
            const form = document.getElementById('deleteForm');
            form.action = url;
            form.submit();
        }
    }
</script>

@endsection

<!-- Halaman Manajemen Sineas -->
@extends('admin.layout.index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Halaman -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="ti ti-users me-2"></i>Manajemen Sineas
                    </h4>
                    <p class="text-muted small mt-2 mb-0">Kelola data pendaftar sineas</p>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.alert')

    <!-- Tabel Sineas -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
            <thead>
                <tr>
                <th class="text-center">No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th class="text-center">Bisa Edit</th>
                <th class="text-center">Persetujuan</th>
                <th>Aksi</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($sineasList as $sineas)
                <tr>
                    <!-- Nomor -->
                    <td class="text-center">
                    <small class="text-muted">
                        {{ ($sineasList->currentPage() - 1) * $sineasList->perPage() + $loop->iteration }}
                    </small>
                    </td>

                    <!-- Nama -->
                    <td>
                    <span class="fw-medium">{{ $sineas->name }}</span>
                    </td>

                    <!-- Email -->
                    <td>
                    <span class="text-muted">{{ $sineas->email }}</span>
                    </td>

                    <!-- Telepon -->
                    <td>{{ $sineas->phone }}</td>

                    <!-- Bisa Edit -->
                    <td class="text-center">
                    @if ($sineas->can_edit === 'Ya')
                        <span class="badge bg-label-success">Ya</span>
                    @else
                        <span class="badge bg-label-secondary">Tidak</span>
                    @endif
                    </td>

                    <!-- Persetujuan -->
                    <td class="text-center">
                    @if ($sineas->agreement)
                        <span class="badge bg-label-primary">Disetujui</span>
                    @else
                        <span class="badge bg-label-warning">Belum</span>
                    @endif
                    </td>

                    <!-- Aksi -->
                    <td>
                    <div class="dropdown">
                        <button
                        type="button"
                        class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                        </button>

                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.sineas.edit', Crypt::encrypt($sineas->id)) }}">
                            <i class="ti ti-pencil me-1"></i> Edit
                        </a>

                        <form
                            action="{{ route('admin.sineas.destroy', Crypt::encrypt($sineas->id)) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin hapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">
                            <i class="ti ti-trash me-1"></i> Delete
                            </button>
                        </form>
                        </div>
                    </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                    <div class="text-muted">
                        <i class="ti ti-inbox" style="font-size: 2rem;"></i>
                        <p class="mt-2 mb-0">Tidak ada data sineas</p>
                    </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            </table>
        </div>

        <!-- Pagination Tengah -->
        @if ($sineasList->count() > 0)
            <div class="card-body d-flex justify-content-center">
            {{ $sineasList->links('pagination::bootstrap-4') }}
            </div>
        @endif
        </div>

    </div>
</div>

<!-- CSS Tambahan -->
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02) !important;
    }

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

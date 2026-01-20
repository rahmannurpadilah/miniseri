<!-- Halaman Manajemen Users -->
@extends('admin.layout.index')

@section('title', 'Miniseri - Users Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header Halaman -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="ti ti-users me-2"></i>Manajemen Pengguna
                    </h4>
                    <p class="text-muted small mt-2 mb-0">
                        Kelola data pengguna yang terdaftar di sistem
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.alert')

    <!-- Tabel Users -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Terdaftar</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($users as $user)
                        <tr>
                            <!-- No -->
                            <td class="text-center">
                                <small class="text-muted">
                                    {{ $loop->iteration }}
                                </small>
                            </td>

                            <!-- Nama -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        <span class="avatar-initial rounded-circle bg-label-secondary">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="fw-medium">{{ $user->name }}</span>
                                </div>
                            </td>

                            <!-- Email -->
                            <td>
                                <span class="text-muted">{{ $user->email }}</span>
                            </td>

                            <!-- Status -->
                            <td class="text-center">
                                <span class="badge bg-label-success">Aktif</span>
                            </td>

                            <!-- Terdaftar -->
                            <td class="text-center">
                                <small class="text-muted">
                                    {{ $user->created_at->format('d M Y') }}
                                </small>
                            </td>

                            <!-- Aksi -->
                            {{-- <td>
                                <div class="dropdown">
                                    <button
                                        type="button"
                                        class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button> --}}

                                    {{-- <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-eye me-1"></i> Detail
                                        </a> --}}

                                        {{-- contoh kalau nanti mau ada --}}
                                        {{-- 
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        --}}
                                    {{-- </div> --}}
                                {{-- </div>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="ti ti-inbox" style="font-size: 2rem;"></i>
                                    <p class="mt-2 mb-0">Tidak ada data pengguna</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination (aktifkan kalau pakai paginate) --}}
        {{-- 
        <div class="card-body d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
        --}}
    </div>

</div>

<!-- CSS kecil agar konsisten -->
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02) !important;
    }
</style>
@endsection

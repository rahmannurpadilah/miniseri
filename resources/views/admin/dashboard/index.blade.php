@extends('admin.layout.index')
@section('title', 'Miniseri - Admin Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- HEADER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="ti ti-dashboard me-2"></i>Dashboard Admin Miniseri
                    </h4>
                    <p class="text-muted small mt-2 mb-0">
                        Selamat datang di panel admin Miniseri, {{ Auth::user()->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="row mb-4">

        <!-- TOTAL USERS -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Total Users</h6>
                            <h3 class="mb-0">{{ $totalUsers }}</h3>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-info">
                                <i class="ti ti-users ti-2x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL PORTOFOLIO -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Total Portofolio</h6>
                            <h3 class="mb-0">{{ $totalFolios }}</h3>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-success">
                                <i class="ti ti-briefcase ti-2x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL PENDAFTAR SINEAS -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Pendaftar Sineas</h6>
                            <h3 class="mb-0">{{ $totalSineasRegistrations }}</h3>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-warning">
                                <i class="ti ti-user-check ti-2x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- USER TERBARU (PALING ATAS) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Terbaru</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">
                        <i class="ti ti-eye me-1"></i> Lihat Semua User
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-muted fw-bold">Nama</th>
                                <th class="text-uppercase text-muted fw-bold">Email</th>
                                <th class="text-uppercase text-muted fw-bold">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <span>{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $user->email }}</td>
                                    <td class="text-muted small">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada user</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- DATA LAIN -->
    <div class="row">

        <!-- PORTOFOLIO UNGGULAN -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Portofolio Unggulan</h5>
                        <a href="{{ route('admin.folios.index') }}" class="btn btn-sm btn-primary">
                            <i class="ti ti-eye me-1"></i> Lihat Semua Folio
                        </a>
                    </div>
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentFolios as $folio)
                                <tr>
                                    <td class="text-truncate" style="max-width:150px;">
                                        {{ $folio->title }}
                                    </td>
                                    <td>
                                        <span class="badge bg-label-primary">Unggulan</span>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $folio->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <p class="text-muted mb-0">Tidak ada data</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- PENDAFTAR SINEAS -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pendaftar Sineas Terbaru</h5>
                    <a href="{{ route('admin.sineas.index') }}" class="btn btn-sm btn-primary">
                        <i class="ti ti-eye me-1"></i> Lihat Semua Sineas
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                {{-- <th>Dapat Edit</th> --}}
                                <th>Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentSineasRegistrations as $registration)
                                <tr>
                                    <td>{{ $registration->name }}</td>
                                    <td class="text-muted">{{ $registration->email }}</td>
                                    {{-- <td>
                                        @if ($registration->can_edit)
                                            <span class="badge bg-label-success">Ya</span>
                                        @else
                                            <span class="badge bg-label-danger">Tidak</span>
                                        @endif
                                    </td> --}}
                                    <td class="text-muted small">
                                        {{ $registration->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted mb-0">Tidak ada pendaftar</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection

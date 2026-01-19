@extends('admin.layout.index')
@section('title', 'Miniseri - Admin Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="ti ti-dashboard me-2"></i>Dashboard Admin Miniseri
                    </h4>
                    <p class="text-muted small mt-2 mb-0">Selamat datang di panel admin Miniseri</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">

        <!-- Total Portofolio -->
        <div class="col-lg-6 col-md-6 mb-3">
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

        <!-- Total Pendaftar Sineas -->
        <div class="col-lg-6 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Total Pendaftar Sineas</h6>
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

    <!-- Data Tables -->
    <div class="row">

        <!-- Portofolio Unggulan -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Portofolio Unggulan</h5>
                        <a href="#" class="text-muted">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                    </div>
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-muted fw-bold">Judul</th>
                                <th class="text-uppercase text-muted fw-bold">Status</th>
                                <th class="text-uppercase text-muted fw-bold">Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentFolios as $folio)
                                <tr>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;">
                                            {{ $folio->title }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-label-primary">Unggulan</span>
                                    </td>
                                    <td>
                                        <span class="text-muted small">
                                            {{ $folio->created_at->format('d M Y') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <p class="text-muted mb-0">Tidak ada data portofolio</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pendaftar Sineas Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pendaftar Sineas Terbaru</h5>
                    <a href="{{ route('admin.sineas.index') }}" class="btn btn-sm btn-primary">
                        <i class="ti ti-eye me-1"></i> Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-muted fw-bold">Nama</th>
                                <th class="text-uppercase text-muted fw-bold">Email</th>
                                <th class="text-uppercase text-muted fw-bold">Telepon</th>
                                <th class="text-uppercase text-muted fw-bold">Dapat Edit</th>
                                <th class="text-uppercase text-muted fw-bold">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSineasRegistrations as $registration)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-initial rounded-circle bg-label-info">
                                                    {{ substr($registration->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <span>{{ $registration->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $registration->email }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $registration->phone }}</span>
                                    </td>
                                    <td>
                                        @if($registration->can_edit)
                                            <span class="badge bg-label-success">Ya</span>
                                        @else
                                            <span class="badge bg-label-danger">Tidak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small">
                                            {{ $registration->created_at->format('d M Y H:i') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted mb-0">Tidak ada pendaftar sineas</p>
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

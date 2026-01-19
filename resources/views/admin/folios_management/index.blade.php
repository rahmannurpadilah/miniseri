@extends('admin.layout.index')
@section('title', 'Miniseri - Folio Management')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">
                            <i class="ti ti-briefcase me-2"></i>Manajemen Folio
                        </h4>
                        <p class="text-muted small mt-2 mb-0">
                            Kelola data portofolio / film Miniseri
                        </p>
                    </div>
                    <a href="{{ route('admin.folios.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>Tambah Folio
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.alert')

    <!-- FOLIO UNGGULAN -->
    @if ($favoriteFolios->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3">Folio Unggulan <span class="text-muted small">(maks. 3)</span></h5>
            </div>

            @foreach ($favoriteFolios as $folio)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card h-100">

                        <!-- Banner -->
                        @if ($folio->banner)
                            <img src="{{ asset('storage/' . $folio->banner) }}"
                                 class="card-img-top"
                                 alt="{{ $folio->title }}"
                                 style="height:180px;object-fit:cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                 style="height:180px;">
                                <span class="text-muted small">Tidak ada banner</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 text-truncate">{{ $folio->title }}</h6>
                                <span class="badge bg-label-primary">Unggulan</span>
                            </div>

                            <p class="text-muted small mb-3">
                                {{ Str::limit($folio->desc_home, 90) }}
                            </p>

                            <small class="text-muted">
                                <i class="ti ti-calendar me-1"></i>
                                {{ $folio->created_at->format('d M Y') }}
                            </small>
                        </div>

                        <!-- Actions -->
                        <div class="card-footer bg-transparent border-top-0 pt-0">
                            <div class="dropdown text-end">
                                <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('admin.folios.show', $folio) }}">
                                        <i class="ti ti-eye me-1"></i>Lihat Detail
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.folios.edit', $folio) }}">
                                        <i class="ti ti-pencil me-1"></i>Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('admin.folios.toggleFavorite', $folio) }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-warning">
                                            <i class="ti ti-star me-1"></i>Hapus dari Unggulan
                                        </button>
                                    </form>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST"
                                          action="{{ route('admin.folios.destroy', $folio) }}"
                                          onsubmit="return confirm('Yakin hapus folio ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item text-danger">
                                            <i class="ti ti-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <hr class="my-4">
    @endif

    <!-- FOLIO LAINNYA -->
    <div class="row">
        <div class="col-12">
            <h5 class="mb-3">Folio Lainnya</h5>
        </div>

        @forelse ($allFolios as $folio)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card h-100">

                    <!-- Banner -->
                    @if ($folio->banner)
                        <img src="{{ asset('storage/' . $folio->banner) }}"
                             class="card-img-top"
                             alt="{{ $folio->title }}"
                             style="height:180px;object-fit:cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                             style="height:180px;">
                            <span class="text-muted small">Tidak ada banner</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h6 class="mb-2 text-truncate">{{ $folio->title }}</h6>
                        <p class="text-muted small mb-3">
                            {{ Str::limit($folio->desc_home, 90) }}
                        </p>
                        <small class="text-muted">
                            <i class="ti ti-calendar me-1"></i>
                            {{ $folio->created_at->format('d M Y') }}
                        </small>
                    </div>

                    <!-- Actions (FIXED) -->
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <div class="dropdown text-end">
                            <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.folios.show', $folio) }}">
                                    <i class="ti ti-eye me-1"></i>Lihat Detail
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.folios.edit', $folio) }}">
                                    <i class="ti ti-pencil me-1"></i>Edit
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('admin.folios.toggleFavorite', $folio) }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-primary">
                                        <i class="ti ti-star me-1"></i>Jadikan Unggulan
                                    </button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <form method="POST"
                                      action="{{ route('admin.folios.destroy', $folio) }}"
                                      onsubmit="return confirm('Yakin hapus folio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item text-danger">
                                        <i class="ti ti-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card py-5 text-center">
                    <p class="text-muted mb-0">Tidak ada folio</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection

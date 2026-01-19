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
            <h4 class="card-title mb-1">
              <i class="ti ti-film me-2"></i>Manajemen Folio
            </h4>
            <p class="text-muted small mb-0">Kelola data portofolio / film Miniseri dengan file upload</p>
          </div>
          <a href="{{ route('admin.folio.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Folio
          </a>
        </div>
      </div>
    </div>
  </div>

  @include('admin.partials.alert')

  <!-- Folio Populer Section -->
  @if($popularFolios->count() > 0)
    <div class="row mb-4">
      <div class="col-12">
        <h5 class="mb-3">
          <i class="ti ti-star-filled me-2" style="color: #ffc107;"></i>Folio Populer ({{ $popularFolios->count() }}/3)
        </h5>
      </div>

      @foreach($popularFolios as $folio)
        <div class="col-lg-4 col-md-6 mb-3">
          <div class="card h-100 position-relative">
            <!-- Badge Populer -->
            <div class="position-absolute top-0 end-0 m-2">
              <span class="badge bg-label-warning">
                <i class="ti ti-star-filled me-1"></i>Populer
              </span>
            </div>

            <!-- Banner Image -->
            @if($folio->banner)
              <img
                src="{{ asset('storage/' . $folio->banner) }}"
                class="card-img-top"
                alt="{{ $folio->title }}"
                style="height:200px;object-fit:cover;">
            @else
              <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                <span class="text-muted"><i class="ti ti-image me-2"></i>Tidak ada banner</span>
              </div>
            @endif

            <div class="card-body">
              <h6 class="card-title mb-2">{{ $folio->title }}</h6>

              <p class="text-muted small mb-3">
                {{ Str::limit($folio->desc_home ?? '', 100) }}
              </p>

              <div class="d-flex justify-content-between align-items-center text-muted small mb-3">
                <span><i class="ti ti-calendar me-1"></i>{{ $folio->created_at->format('d M Y') }}</span>
              </div>

              <!-- Action Buttons -->
              <div class="d-flex gap-2">
                <a href="{{ route('admin.folio.show', $folio) }}" class="btn btn-sm btn-info flex-fill">
                  <i class="ti ti-eye me-1"></i>Lihat
                </a>
                <a href="{{ route('admin.folio.edit', $folio) }}" class="btn btn-sm btn-warning flex-fill">
                  <i class="ti ti-pencil me-1"></i>Edit
                </a>
                <div class="dropdown flex-fill">
                  <button class="btn btn-sm btn-secondary dropdown-toggle w-100" data-bs-toggle="dropdown">
                    <i class="ti ti-dots-vertical me-1"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end w-100">
                    <form method="POST" action="{{ route('admin.folio.togglePopular', $folio) }}" class="d-inline">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="dropdown-item">
                        <i class="ti ti-star-off me-1"></i>Hapus Populer
                      </button>
                    </form>
                    <form method="POST" action="{{ route('admin.folio.destroy', $folio) }}" onsubmit="return confirm('Yakin hapus folio ini?')" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item text-danger">
                        <i class="ti ti-trash me-1"></i>Hapus
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <hr class="my-4">
  @endif

  <!-- Semua Folio Section -->
  <div class="row mb-4">
    <div class="col-12">
      <h5 class="mb-3">
        <i class="ti ti-list me-2"></i>Daftar Semua Folio ({{ $allFolios->total() }} data)
      </h5>
    </div>

    <div class="col-12">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-light">
            <tr>
              <th>Banner</th>
              <th>Judul</th>
              <th>Deskripsi Singkat</th>
              <th>Status</th>
              <th>Tanggal Buat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($allFolios as $folio)
              <tr>
                <!-- Banner Thumbnail -->
                <td>
                  @if($folio->banner)
                    <img src="{{ asset('storage/' . $folio->banner) }}" alt="{{ $folio->title }}" class="img-fluid rounded" style="max-width:60px;height:50px;object-fit:cover;">
                  @else
                    <span class="text-muted small">-</span>
                  @endif
                </td>

                <!-- Judul -->
                <td>
                  <span class="text-truncate d-inline-block" style="max-width:150px;">
                    {{ $folio->title }}
                  </span>
                </td>

                <!-- Deskripsi -->
                <td>
                  <span class="text-truncate d-inline-block text-muted small" style="max-width:200px;">
                    {{ Str::limit($folio->desc_home ?? '', 50) }}
                  </span>
                </td>

                <!-- Status Populer -->
                <td>
                  @if($folio->is_popular)
                    <span class="badge bg-label-warning">
                      <i class="ti ti-star-filled me-1"></i>Populer
                    </span>
                  @else
                    <span class="badge bg-label-secondary">Biasa</span>
                  @endif
                </td>

                <!-- Tanggal -->
                <td>
                  <small class="text-muted">{{ $folio->created_at->format('d M Y') }}</small>
                </td>

                <!-- Aksi -->
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-icon btn-secondary dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="{{ route('admin.folio.show', $folio) }}">
                        <i class="ti ti-eye me-1"></i>Lihat Detail
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.folio.edit', $folio) }}">
                        <i class="ti ti-pencil me-1"></i>Edit
                      </a>
                      @if($folio->is_popular)
                        <form method="POST" action="{{ route('admin.folio.togglePopular', $folio) }}" class="d-inline">
                          @csrf
                          @method('PATCH')
                          <button type="submit" class="dropdown-item">
                            <i class="ti ti-star-off me-1"></i>Hapus Populer
                          </button>
                        </form>
                      @else
                        <form method="POST" action="{{ route('admin.folio.togglePopular', $folio) }}" class="d-inline">
                          @csrf
                          @method('PATCH')
                          <button type="submit" class="dropdown-item">
                            <i class="ti ti-star me-1"></i>Jadikan Populer
                          </button>
                        </form>
                      @endif
                      <div class="dropdown-divider"></div>
                      <form method="POST" action="{{ route('admin.folio.destroy', $folio) }}" onsubmit="return confirm('Yakin hapus folio ini? File akan dihapus permanen.')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">
                          <i class="ti ti-trash me-1"></i>Hapus
                        </button>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-5">
                  <p class="text-muted mb-0">
                    <i class="ti ti-inbox me-2"></i>Tidak ada data folio
                  </p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  @if($allFolios->hasPages())
    <div class="d-flex justify-content-center">
      {{ $allFolios->links() }}
    </div>
  @endif

</div>
@endsection

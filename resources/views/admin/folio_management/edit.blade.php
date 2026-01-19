@extends('admin.layout.index')
@section('title', 'Miniseri - Edit Folio')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h4 class="card-title mb-1">
              <i class="ti ti-film me-2"></i>Edit Folio
            </h4>
            <p class="text-muted small mb-0">Perbarui data folio: {{ $folio->title }}</p>
          </div>
          <a href="{{ route('admin.folio.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left me-1"></i> Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Form Card -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.folio.update', $folio) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-3">
              <label for="title" class="form-label">Judul Folio</label>
              <input 
                type="text" 
                class="form-control @error('title') is-invalid @enderror" 
                id="title" 
                name="title" 
                placeholder="Masukkan judul folio"
                value="{{ old('title', $folio->title) }}">
              @error('title')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <!-- Deskripsi Singkat -->
            <div class="mb-3">
              <label for="desc_home" class="form-label">Deskripsi Singkat</label>
              <textarea 
                class="form-control @error('desc_home') is-invalid @enderror" 
                id="desc_home" 
                name="desc_home" 
                rows="3"
                placeholder="Deskripsi singkat (maks 160 karakter)">{{ old('desc_home', $folio->desc_home) }}</textarea>
              @error('desc_home')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
              <small class="text-muted">Maksimal 160 karakter</small>
            </div>

            <!-- Deskripsi Panjang -->
            <div class="mb-3">
              <label for="desc_long" class="form-label">Deskripsi Lengkap</label>
              <textarea 
                class="form-control @error('desc_long') is-invalid @enderror" 
                id="desc_long" 
                name="desc_long" 
                rows="5"
                placeholder="Deskripsi lengkap folio">{{ old('desc_long', $folio->desc_long) }}</textarea>
              @error('desc_long')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4">

            <!-- Banner Image Upload -->
            <div class="mb-3">
              <label for="banner" class="form-label">
                <i class="ti ti-image me-1"></i>Banner / Gambar Utama (Opsional)
              </label>
              @if($folio->banner)
                <div class="mb-2">
                  <p class="small text-muted mb-1">Banner saat ini:</p>
                  <img src="{{ asset('storage/' . $folio->banner) }}" alt="{{ $folio->title }}" class="img-fluid rounded" style="max-width:200px;max-height:150px;">
                </div>
              @endif
              <input 
                type="file" 
                class="form-control @error('banner') is-invalid @enderror" 
                id="banner" 
                name="banner" 
                accept="image/*">
              @error('banner')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
              <small class="text-muted">Biarkan kosong jika tidak ingin mengubah. Format: JPG, PNG, GIF | Maksimal 5MB</small>
            </div>

            <!-- Banner Preview -->
            <div class="mb-3">
              <div id="bannerPreview" class="d-none">
                <p class="small text-muted mb-2">Preview Banner Baru:</p>
                <img id="bannerImg" src="" alt="Banner Preview" class="img-fluid rounded" style="max-width:300px;max-height:200px;">
              </div>
            </div>

            <!-- Trailer Video Upload -->
            <div class="mb-3">
              <label for="trailer" class="form-label">
                <i class="ti ti-video me-1"></i>Trailer / Video (Opsional)
              </label>
              @if($folio->trailer)
                <div class="mb-2">
                  <p class="small text-muted mb-1">Trailer saat ini:</p>
                  <video style="max-width:200px;max-height:150px;" controls>
                    <source src="{{ asset('storage/' . $folio->trailer) }}" type="video/mp4">
                  </video>
                </div>
              @endif
              <input 
                type="file" 
                class="form-control @error('trailer') is-invalid @enderror" 
                id="trailer" 
                name="trailer" 
                accept="video/*">
              @error('trailer')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
              <small class="text-muted">Biarkan kosong jika tidak ingin mengubah. Format: MP4, AVI, MOV | Maksimal 100MB</small>
            </div>

            <!-- Trailer Preview -->
            <div class="mb-3">
              <div id="trailerPreview" class="d-none">
                <p class="small text-muted mb-2">Preview Trailer Baru:</p>
                <video id="trailerVideo" style="max-width:300px;max-height:200px;" controls>
                  <source id="trailerSource" type="video/mp4">
                </video>
              </div>
            </div>

            <hr class="my-4">

            <!-- Budget -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="budget" class="form-label">Budget (Opsional)</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input 
                    type="number" 
                    class="form-control @error('budget') is-invalid @enderror" 
                    id="budget" 
                    name="budget" 
                    placeholder="0"
                    value="{{ old('budget', $folio->budget) }}">
                </div>
                @error('budget')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Kualitas -->
              <div class="col-md-6 mb-3">
                <label for="quality" class="form-label">Kualitas (Opsional)</label>
                <input 
                  type="text" 
                  class="form-control @error('quality') is-invalid @enderror" 
                  id="quality" 
                  name="quality" 
                  placeholder="Contoh: 4K, Full HD, HD"
                  value="{{ old('quality', $folio->quality) }}">
                @error('quality')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Genre -->
            <div class="mb-3">
              <label for="genre" class="form-label">Genre (Opsional)</label>
              <input 
                type="text" 
                class="form-control @error('genre') is-invalid @enderror" 
                id="genre" 
                name="genre" 
                placeholder="Contoh: Drama, Action, Comedy"
                value="{{ old('genre', $folio->genre) }}">
              @error('genre')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <!-- Durasi -->
            <div class="mb-3">
              <label for="duration" class="form-label">Durasi (Opsional)</label>
              <div class="input-group">
                <input 
                  type="number" 
                  class="form-control @error('duration') is-invalid @enderror" 
                  id="duration" 
                  name="duration" 
                  placeholder="0"
                  value="{{ old('duration', $folio->duration) }}">
                <span class="input-group-text">menit</span>
              </div>
              @error('duration')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4">

            <!-- Submit Buttons -->
            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('admin.folio.index') }}" class="btn btn-secondary">
                <i class="ti ti-x me-1"></i>Batal
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-check me-1"></i>Update Folio
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Script untuk preview file -->
<script>
  // Preview Banner
  document.getElementById('banner').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('bannerImg').src = e.target.result;
        document.getElementById('bannerPreview').classList.remove('d-none');
      }
      reader.readAsDataURL(file);
    }
  });

  // Preview Trailer
  document.getElementById('trailer').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('trailerSource').src = e.target.result;
        document.getElementById('trailerVideo').load();
        document.getElementById('trailerPreview').classList.remove('d-none');
      }
      reader.readAsDataURL(file);
    }
  });
</script>

@endsection

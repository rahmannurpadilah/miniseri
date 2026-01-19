@extends('admin.layout.index')
@section('title', 'Miniseri - Edit Folio')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <h4 class="mb-4">Edit Folio: {{ $folio->title }}</h4>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.folios.update', $folio) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Judul Folio <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $folio->title) }}"
                               placeholder="Masukkan judul folio"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="is_favorite" class="form-label">Jadikan Favorit</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_favorite" 
                                   name="is_favorite"
                                   value="1"
                                   {{ old('is_favorite', $folio->is_favorite) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_favorite">
                                Tandai sebagai film favorit (maksimal 3)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Banner Upload -->
                <div class="mb-3">
                    <label for="banner" class="form-label">Banner (Kosongkan jika tidak ingin mengubah)</label>
                    <div class="input-group">
                        <input type="file" 
                               class="form-control @error('banner') is-invalid @enderror" 
                               id="banner" 
                               name="banner" 
                               accept="image/*">
                        <span class="input-group-text">JPG, PNG, GIF (Max: 2MB)</span>
                    </div>
                    @error('banner')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    <!-- Current Banner -->
                    @if ($folio->banner)
                        <div class="mt-2">
                            <small class="text-muted">Banner Saat Ini:</small>
                            <div>
                                <img src="{{ asset('storage/' . $folio->banner) }}" 
                                     style="max-width: 200px; height: 150px; object-fit: cover;" 
                                     alt="Current Banner">
                            </div>
                        </div>
                    @endif

                    <div id="bannerPreview" class="mt-2"></div>
                </div>

                <!-- Trailer Upload -->
                <div class="mb-3">
                    <label for="trailer" class="form-label">Trailer Video (Kosongkan jika tidak ingin mengubah)</label>
                    <div class="input-group">
                        <input type="file" 
                               class="form-control @error('trailer') is-invalid @enderror" 
                               id="trailer" 
                               name="trailer" 
                               accept="video/*">
                        <span class="input-group-text">MP4, WebM, AVI (Max: 100MB)</span>
                    </div>
                    @error('trailer')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    <!-- Current Trailer -->
                    @if ($folio->trailer)
                        <div class="mt-2">
                            <small class="text-muted">Trailer Saat Ini:</small>
                            <div>
                                <video width="200" height="150" controls style="object-fit: cover;">
                                    <source src="{{ asset('storage/' . $folio->trailer) }}" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Descriptions -->
                <div class="mb-3">
                    <label for="desc_home" class="form-label">Deskripsi Singkat (Home) <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('desc_home') is-invalid @enderror" 
                              id="desc_home" 
                              name="desc_home" 
                              rows="2"
                              placeholder="Deskripsi singkat untuk halaman home"
                              maxlength="255"
                              required>{{ old('desc_home', $folio->desc_home) }}</textarea>
                    <small class="text-muted">Maksimal 255 karakter</small>
                    @error('desc_home')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desc_side" class="form-label">Deskripsi Sidebar <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('desc_side') is-invalid @enderror" 
                              id="desc_side" 
                              name="desc_side" 
                              rows="3"
                              placeholder="Deskripsi untuk sidebar"
                              required>{{ old('desc_side', $folio->desc_side) }}</textarea>
                    @error('desc_side')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desc_full" class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('desc_full') is-invalid @enderror" 
                              id="desc_full" 
                              name="desc_full" 
                              rows="5"
                              placeholder="Deskripsi lengkap folio"
                              required>{{ old('desc_full', $folio->desc_full) }}</textarea>
                    @error('desc_full')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.folios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Banner preview
    document.getElementById('banner').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('bannerPreview').innerHTML = 
                    '<strong>Preview Banner Baru:</strong><br/><img src="' + e.target.result + '" style="max-width: 100%; height: 200px; object-fit: cover;" alt="Preview">';
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection

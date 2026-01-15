<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Miniseri - Detail Folio</title>

  {{-- Bootstrap CSS --}}
  <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/style/css/homepage.css') }}">
  <link
    rel="stylesheet"
    href="{{ asset('assets/fontawesome/css/all.min.css') }}"
    />

</head>
<body>

<!-- BACK TO HOME -->
<a href="{{ route('homepage') }}" class="back-home-btn">
  <i class="fa-solid fa-arrow-left"></i>
  <span>Home</span>
</a>

<!-- HERO FILM -->
<section class="film-hero">
  <img
    src="{{ asset('assets/img/film/foto/' . $folio->banner) }}"
    alt="Banner Film"
    class="film-hero-bg"
  >

  <div class="film-hero-overlay"></div>

  <div class="container">
    <div class="film-hero-content">
      <span class="film-badge">Drama • Romantis</span>
      <h1>{{ $folio->title }}</h1>
      <p>{{ $folio->desc_home }}</p>
    </div>
  </div>
</section>
<section class="film-detail-glass section-md">
  <div class="container">



    <!-- GLASS WRAP -->
    <div class="film-glass-wrap glass-card">

      <!-- ATAS: TRAILER + INFO -->
      <div class="row g-4 align-items-start">
        <div class="col-lg-7">
          <div class="ratio ratio-16x9 rounded overflow-hidden">
            {{-- <iframe
              src="https://www.youtube.com/embed/aqz-KE-bpKQ"
              allowfullscreen>
            </iframe> --}}
            <video width="100%" controls>
                <source src="{{ asset('assets/img/film/video/' . $folio->trailer) }}" type="video/mp4">
            </video>
          </div>
        </div>

        <div class="col-lg-5">
          <span class="film-badge">Drama • Romantis</span>
          <h2 class="film-title">{{ $folio->title }}</h2>

          <p class="film-desc-short">
            {!! nl2br(e($folio->desc_side)) !!}
          </p>
        </div>
      </div>

      <!-- DIVIDER TIPIS -->
      <div class="film-divider"></div>

      <!-- BAWAH: DESKRIPSI PANJANG -->
      <div class="film-desc-long">
        <h5>Tentang Film</h5>
        <p>
            {!! nl2br(e($folio->desc_full)) !!}
        </p>
      </div>

    </div>
  </div>
</section>


  <!-- Bootstrap JS -->
  <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/style/js/homepage.js') }}"></script>
</body>
</html>

<section id="folio" class="profil-film section-md">
  <div class="container">

    <!-- Heading -->
    <div class="row mb-5">
      <div class="col-lg-8">
        <p class="section-eyebrow">FOLIO</p>
        <h2 class="section-title">Film Unggulan di Miniseri</h2>
        <p class="section-desc">
          Cerita-cerita pilihan yang dikemas dalam format video vertikal
          untuk pengalaman menonton yang singkat namun berkesan.
        </p>
      </div>
    </div>

    <!-- Film Grid -->
    <div class="row g-4">

      @foreach ($folios as $index => $folio)
        <div class="col-md-6 col-lg-4">
          <div class="film-card glass-card reveal">
            <div class="film-thumb">
              <img src="{{ asset('assets/img/film/foto/' . $folio->banner) }}" alt="Film-{{ $index + 1 }}">
            </div>
            <div class="film-body">
              <h4>{{ $folio->title }}</h4>
              <p>
                {{ $folio->desc_home }}
              </p>
              <a
                href="/detail/profile/{{ Crypt::encrypt($folio->id) }}"
                class="btn w-btn pink-btn rounded-pill mt-4">
                Lihat Detail
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

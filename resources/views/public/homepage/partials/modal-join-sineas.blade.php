<div class="modal fade" id="modalRegister" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-glass">

            <!-- HEADER -->
            <div class="modal-header px-lg-5 pt-5 border-0">
                <div>
                <h4 class="fw-bold mb-1">Daftar Sebagai Sineas</h4>
                <p class="text-muted mb-0">
                    Pendaftaran karya film untuk aplikasi miniseri.id
                </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body px-lg-5 pb-5">

                <form class="mt-4" method="POST" action="{{ route('sineas.register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Sineas</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                        Bersedia mengedit film sesuai format miniseri.id
                        </label>
                        <select class="form-select" name="can_edit" required>
                        <option value="">Pilih</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                        </select>
                        <small class="text-muted">
                        Vertical dan berdurasi 2–3 menit per <i>clip</i>
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Captcha</label>
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        {{-- @error('g-recaptcha-response')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror --}}
                    </div>

                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="agreement" required id="agree">
                        <label class="form-check-label text-muted" for="agree">
                        Dengan ini saya yang memiliki hak penuh atas kepemilikan karya,
                        dengan sadar dan tanpa paksaan mendaftarkan karya saya untuk dapat
                        ditayangkan dan dipasarkan di platform miniseri.id
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="btn pink-btn rounded-pill w-100 mt-4 py-3"
                    >
                        DAFTAR SEKARANG
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
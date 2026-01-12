<div class="modal fade" id="modalFaq" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content modal-glass">

      <!-- HEADER -->
      <div class="modal-header border-0 px-lg-5 pt-5">
        <div>
          <h4 class="fw-bold mb-1">Syarat dan Ketentuan</h4>
          <p class="text-muted mb-0">
            Mengatur penggunaan website dan layanan yang disediakan
          </p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body px-lg-5 pb-5">
        <div class="pdf-wrapper">
          <iframe
            src="{{ asset('assets/files/mou.pdf') }}"
            loading="lazy"
            title="Syarat dan Ketentuan"
          ></iframe>
        </div>
      </div>

    </div>
  </div>
</div>

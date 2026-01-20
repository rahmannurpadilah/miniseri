<!-- Pesan Notifikasi -->
@if ($message = Session::get('success'))
<div class="alert alert-solid-success d-flex align-items-center mb-4" role="alert">
    <span class="alert-icon rounded">
        <i class="ti ti-check"></i>
    </span>
    <div>
        <strong>Sukses!</strong> {{ $message }}
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-solid-danger d-flex align-items-center mb-4" role="alert">
    <span class="alert-icon rounded">
        <i class="ti ti-ban"></i>
    </span>
    <div>
        <strong>Error!</strong> {{ $message }}
    </div>
</div>
@endif

@if ($errors->any())
<div class="alert alert-solid-danger d-flex align-items-center mb-4" role="alert">
    <span class="alert-icon rounded">
        <i class="ti ti-alert-circle"></i>
    </span>
    <div>
        <strong>Error!</strong>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<!-- Alert auto hilang -->
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.remove();
        });
    }, 3000);
</script>

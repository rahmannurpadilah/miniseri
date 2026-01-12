{{-- SUCCESS --}}
@if (session('success'))
    <div class="toast-glass success" id="toastMsg">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

{{-- ERROR --}}
@if (session('error'))
    <div class="toast-glass error" id="toastMsg">
        <i class="fa-solid fa-circle-xmark"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

{{-- VALIDATION --}}
@if ($errors->any())
    <div class="toast-glass error" id="toastError">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <div class="toast-text">
            <strong>Periksa kembali isian:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

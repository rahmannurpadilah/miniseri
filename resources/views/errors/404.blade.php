@extends('errors.layout.index')

@section('title', '404')

@section('content')
<div class="error-card">

    <div class="error-code">404</div>

    <div class="error-title">Halaman Tidak Ditemukan</div>

    <p class="error-desc">
        Halaman yang kamu cari mungkin sudah dipindahkan,
        dihapus, atau tidak tersedia.
    </p>

    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn btn-primary ">Kembali ke Home</a>
        <a href="{{ url('/#folio') }}" class="btn btn-secondary">Lihat Film</a>
    </div>

</div>
@endsection

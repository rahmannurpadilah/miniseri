@extends('errors.layout.index')

@section('title', '500')

@section('content')
<div class="error-card">

    <div class="error-code">500</div>

    <div class="error-title">Terjadi Kesalahan Server</div>

    <p class="error-desc">
        Sistem sedang mengalami gangguan.
        Silakan coba beberapa saat lagi.
    </p>

    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Home</a>
    </div>

</div>
@endsection

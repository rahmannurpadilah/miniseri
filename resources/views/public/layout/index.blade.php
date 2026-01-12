<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>

  {{-- Bootstrap CSS --}}
  <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/style/css/homepage.css') }}">
  <link
    rel="stylesheet"
    href="{{ asset('assets/fontawesome/css/all.min.css') }}"
    />
    
  <!-- Satoshi (Heading & UI) -->
  <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">

  <!-- Inter (Body Text) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  
</head>
<body tabindex="0">

    @include('public.layout.partials.header')

    <main>
        @include('public.layout.partials.alert')
        @yield('content')
    </main>

    @include('public.layout.partials.scrolltopbtn')

    @include('public.layout.partials.footer')

  <!-- Bootstrap JS -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/style/js/homepage.js') }}"></script>
</body>
</html>

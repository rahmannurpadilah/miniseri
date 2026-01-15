<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Terjadi Kesalahan') | Miniseri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">

    {{-- Error CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/style/css/error-page.css') }}">
</head>
<body>

    <main class="error-wrapper">
        @yield('content')
    </main>

</body>
</html>

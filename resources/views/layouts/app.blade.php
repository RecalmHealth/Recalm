<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recalm')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    @include('review.components.sidebar')

    <div class="flex-grow-1 d-flex flex-column min-vh-100 overflow-auto">
        @include('review.components.navbar-app')

        {{-- Konten utama --}}
        <main class="flex-grow-1 p-3 p-md-4">
            @yield('content')

        </main>
    </div>
  </div>

  @vite('resources/js/app.js')
</body>
</html>

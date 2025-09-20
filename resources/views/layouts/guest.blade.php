<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Recalm', 'Recalm')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        @vite('resources/sass/app.scss')
</head>
<body>
    @include('review.components.navbar')

    <main class="py-4">
        @yield('content')
    </main>

    @include('review.components.footer')
    @vite('resources/js/app.js')

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recalm')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite('resources/sass/app.scss')
    <style>
        body {
            background-color: #eef2f6; /* Light bluish background */
            overflow: hidden; /* Prevent body scroll */
            height: 100vh;
        }
        .main-content {
            width: 100%;
            height: 100vh;
            overflow-y: scroll; /* Force scrollbar */
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="d-flex h-100">

        
        @include('review.components.sidebar')
        <div class="main-content">
            @include('review.components.navbar-app')

            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- @vite('resources/js/app.js') --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            })
        });
    </script>
    @yield('scripts')
</body>
</html>

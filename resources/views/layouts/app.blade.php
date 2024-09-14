<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Head content -->
</head>
<body>
    <div id="app">
        <!-- Navigation or header -->

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
    </div>

    <!-- Scripts -->
    @vite('resources/js/app.js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Manager</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <x-ui.navbar-2 />

    <x-ui.sidebar />
    
    <main>
        @yield('content')
    </main>
</body>
@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Toast.show(@json(session('success')), 'success');
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Toast.show(@json(session('error')), 'error');
        });
    </script>
@endif
</html>
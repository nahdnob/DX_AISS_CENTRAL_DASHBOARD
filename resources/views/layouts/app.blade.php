<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AISS Central Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
</head>
<body>
    <x-ui.navbar />
    
    <x-ui.header>@yield('header')</x-ui.header>

    <main class="flex-grow max-w-7xl mx-auto w-full">@yield('content')</main>
</body>
</html>
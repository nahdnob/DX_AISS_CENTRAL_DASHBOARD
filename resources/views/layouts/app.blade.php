<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AISsee</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
</head>
<body>
    @include('layouts.partials.navbar')
    @include('layouts.partials.header', [
        'title' => $pageTitle ?? 'Dashboard'
    ])
    <main class="flex-grow max-w-7xl mx-auto w-full">
		@yield('content') 
	</main>
</body>
</html>
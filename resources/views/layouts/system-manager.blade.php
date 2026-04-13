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

    @auth
        <x-ui.modal id="profile-modal" maxWidth="max-w-md">
            <x-ui.profile-card
                :name="Auth::user()->name"
                :email="Auth::user()->email ?? ''"
                :verified="Auth::user()->email_verified_at !== null"
                :npk="Auth::user()->npk"
                :image="Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/images/profile-blank.jpg')"
            />
        </x-ui.modal>
    @endauth
    <x-ui.modal id="login-modal" maxWidth="max-w-3xl">
        <x-auth.login-form />
    </x-ui.modal>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
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
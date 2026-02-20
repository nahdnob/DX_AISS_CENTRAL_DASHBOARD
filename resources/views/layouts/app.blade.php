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

    <script>
        function openModal(id) {
            const modal   = document.getElementById(id);
            const overlay = document.getElementById(id + "-overlay");

            overlay.classList.remove("hidden");
            modal.classList.remove("hidden");

            void modal.offsetWidth;

            modal.classList.remove("opacity-0", "scale-95");
            modal.classList.add("opacity-100", "scale-100");

            overlay.addEventListener("click", () => closeModal(id));
        }

        function closeModal(id) {
            const modal   = document.getElementById(id);
            const overlay = document.getElementById(id + "-overlay");

            modal.classList.remove("opacity-100", "scale-100");
            modal.classList.add("opacity-0", "scale-95");

            setTimeout(() => {
                modal.classList.add("hidden");
                overlay.classList.add("hidden");
            }, 300);
        }
    </script>
</body>
</html>
@props(['id'])

<!-- Overlay -->
<div id="{{ $id }}-overlay"
    data-modal-overlay
    class="hidden fixed inset-0 bg-black/50 z-40 transition-opacity duration-300">
</div>

<!-- Modal Wrapper -->
<div id="{{ $id }}"
     class="hidden fixed top-1/2 left-1/2
            -translate-x-1/2 -translate-y-1/2
            opacity-0 scale-95 z-50
            transition-all duration-300">

    <div class="relative inline-block">



        {{ $slot }}

    </div>
</div>
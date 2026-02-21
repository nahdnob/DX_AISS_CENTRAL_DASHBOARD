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

        <!-- Close Button -->
        <button data-modal-close="{{ $id }}"
                class="absolute -top-3 -right-3 bg-red-500 rounded-full shadow p-1">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M6 6l12 12M6 18L18 6"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"/>
            </svg>
        </button>

        {{ $slot }}

    </div>
</div>
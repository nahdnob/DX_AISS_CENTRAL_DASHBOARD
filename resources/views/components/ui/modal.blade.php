@props([
    'id',
    'maxWidth' => 'max-w-md'
])

<!-- Overlay -->
<div id="{{ $id }}-overlay"
     class="hidden fixed inset-0 bg-black/50 z-40 transition-opacity duration-300">
</div>

<!-- Modal -->
<div id="{{ $id }}"
     class="hidden fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
            opacity-0 scale-95 z-50 w-[90%] {{ $maxWidth }}
            transition-all duration-300">
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 relative">
        
        <!-- Close Button -->
        <button onclick="closeModal('{{ $id }}')" 
            class="absolute top-3 right-5 text-gray-500 hover:text-gray-700"
        >
            ✕
        </button>

        {{ $slot }}

    </div>

</div>
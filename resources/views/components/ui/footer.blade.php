<footer class="mt-auto py-6 relative overflow-hidden">
    {{-- Decorative subtle top border --}}
    <div class="absolute top-0 left-10 right-10 h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
    
    <div class="px-4 mx-auto w-full">
        <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
            {{-- Left side: System name --}}
            <div class="flex items-center gap-2 text-sm text-gray-400">
                <span class="font-bold tracking-wider text-red-600">DENSO</span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                <span class="font-medium">AISS Central Dashboard</span>
            </div>

            {{-- Center: Credits --}}
            <!-- <div class="flex items-center gap-1.5 text-sm font-medium text-gray-500">
                <span>Dibuat dengan</span>
                <span class="px-2 py-0.5 text-[10px] font-bold tracking-widest text-red-600 uppercase bg-red-50 border border-red-100 rounded-md shadow-sm">IKHLAS</span>
                <span>by</span>
                <div class="flex items-center justify-center w-6 h-6 rounded-md bg-gradient-to-br from-gray-800 to-gray-900 text-white shadow-sm">
                    <span class="font-bold text-[11px]">b&</span>
                </div>
            </div> -->
            
            {{-- Right side: Copyright / Year --}}
            <div class="text-[11px] font-medium text-gray-400">
                &copy; {{ date('Y') }} PT Denso Indonesia
            </div>
        </div>
    </div>
</footer>
@extends('layouts.system-manager')

@section('content')
<div class="p-4 sm:ml-16 mt-14 transition-all duration-300">
    <div class="p-4 min-h-[calc(100vh-5rem)]">

        {{-- ===== HERO HEADER ===== --}}
        <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">
            <div class="absolute right-0 top-0 w-48 h-full bg-gradient-to-l from-red-50 to-transparent pointer-events-none"></div>
            <div class="absolute right-8 top-1/2 -translate-y-1/2 w-24 h-24 rounded-full bg-red-100/40 pointer-events-none"></div>

            <div class="relative flex items-center justify-between gap-5 px-6 py-5">
                <div class="flex items-center gap-5">
                    <div class="shrink-0 w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Cycle Time Settings</h1>
                        <p class="mt-1 text-sm text-gray-500 max-w-lg leading-relaxed">
                            Configure operating modes and patterns for the
                            <span class="font-semibold text-red-600">AISS cycle time</span> monitoring module.
                        </p>
                    </div>
                </div>
            </div>
            <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-red-500 to-rose-700 rounded-l-2xl"></div>
        </div>

        {{-- ===== DATA TABLE & ACTION ===== --}}
        <div>
            <div class="flex items-end justify-between mb-3">
                <div>
                    <p class="text-xs font-bold tracking-widest text-red-600 uppercase">Configuration</p>
                    <h2 class="text-xl font-bold text-gray-900">Registered Patterns</h2>
                </div>
                <div class="flex items-center gap-2">
                    <button id="add-modal-btn" class="flex items-center gap-1.5 px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-red-600 to-rose-700 rounded-lg shadow-sm shadow-red-200 hover:brightness-110 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Add Pattern</span>
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                {{-- Search bar --}}
                <div class="p-4 border-b border-gray-100">
                    <form id="pattern-search-form" class="flex items-center gap-2">
                        <div class="relative flex-1 max-w-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m21 21-3.5-3.5M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="search" id="simple-search"
                                   placeholder="Search patterns..."
                                   class="block w-full pl-9 pr-4 py-2 text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"/>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/50">
                                <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Pattern Name</th>
                                @foreach ($sensors as $sensor)
                                    <th class="px-3 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase text-center w-16" title="{{$sensor->name}}">{{$sensor->id}}</th>
                                @endforeach
                                <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase text-center">Cycle/Tact</th>
                                <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase text-center">Threshold (Min-Max)</th>
                                <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($patterns as $index => $pattern)
                                <tr class="hover:bg-red-50/40 transition-colors duration-150 group">
                                    {{-- Pattern Name --}}
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="font-semibold text-gray-800 text-sm flex items-center gap-2.5">
                                            <div class="w-2.5 h-2.5 rounded-full bg-red-500 shadow-sm shadow-red-200"></div>
                                            {{ $pattern->name }}
                                        </div>
                                    </td>
                                    
                                    {{-- Sensors --}}
                                    @foreach ($sensors as $sensor)
                                        @php
                                            $isActive = $pattern->sensors->contains('id', $sensor->id);
                                        @endphp
                                        <td class="px-3 py-4 text-center">
                                            @if($isActive)
                                                <div class="flex justify-center">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-600" title="Active">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    </span>
                                                </div>
                                            @else
                                                <div class="flex justify-center">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-300" title="Off">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                                    </span>
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach

                                    {{-- Timing --}}
                                    <td class="px-5 py-4 text-center font-mono text-gray-700 bg-gray-50/30">
                                        {{ $pattern->cycle_time }}<span class="text-xs text-gray-400">s</span>
                                    </td>
                                    <td class="px-5 py-4 text-center text-gray-500 text-xs">
                                        <span class="font-mono text-gray-700">{{ $pattern->min_time }}</span>s
                                        <span class="mx-1 text-gray-300">—</span>
                                        <span class="font-mono text-gray-700">{{ $pattern->max_time }}</span>s
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                            <button id="btn-modal-edit-{{ $pattern->id }}" class="w-7 h-7 flex items-center justify-center rounded-lg bg-sky-100 text-sky-600 hover:bg-sky-200 transition" title="Edit">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <form action="{{ route('settings.destroy', $pattern->id) ?? '#' }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pattern: {{ $pattern->name }}?')"
                                                    title="Delete"
                                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="px-5 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                            </svg>
                                            <span class="text-sm">Belum ada data pattern.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
    <x-ui.footer />
</div>

@endsection
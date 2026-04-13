@extends('layouts.system-manager')

@section('content')
<div class="p-4 sm:ml-16 mt-14 transition-all duration-300">
    <div class="p-4 min-h-[calc(100vh-5rem)]">
        {{-- ===== HERO HEADER ===== --}}
        <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">
            {{-- Decorative Background --}}
            <div class="absolute right-0 top-0 w-48 h-full bg-gradient-to-l from-red-50 to-transparent pointer-events-none"></div>
            <div class="absolute right-8 top-1/2 -translate-y-1/2 w-24 h-24 rounded-full bg-red-100/40 pointer-events-none"></div>
            <div class="relative flex items-center gap-5 px-6 py-5">
                {{-- Icon --}}
                <div class="shrink-0 w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                {{-- Text --}}
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Line Performance</h1>
                    <p class="mt-1 text-sm text-gray-500 max-w-lg leading-relaxed">
                        Track and manage monthly OEE performance data for the
                        <span class="font-semibold text-red-600">AISS production line</span>.
                        Monitor target vs actual metrics across all operational periods.
                    </p>
                </div>
            </div>
            {{-- Left red bar accent --}}
            <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-red-500 to-rose-700 rounded-l-2xl"></div>
        </div>
        {{-- ===== NEW ENTRY FORM ===== --}}
        <div class="mb-6">
            {{-- Title --}}
            <div class="ml-2 mb-3">
                <p class="text-xs font-bold tracking-widest text-red-600 uppercase">Operations Input</p>
                <h2 class="text-xl font-bold text-gray-900">New Performance Entry</h2>
            </div>
            {{-- Form --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <form action="{{ route('line-performance.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3 items-end">
                        {{-- Month --}}
                        <div class="flex-1 min-w-0">
                            <label for="line-performance-month" class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Month</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <select id="line-performance-month" name="line-performance-month"
                                    class="w-full border border-gray-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition appearance-none">
                                    <option value="">Choose month...</option>
                                    @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                                        <option value="{{ $m }}" {{ old('month') == $m ? 'selected' : '' }}>{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Year --}}
                        <div class="flex-1 min-w-0">
                            <label for="line-performance-year" class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Year</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <select id="line-performance-year" name="line-performance-year"
                                    class="w-full border border-gray-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition appearance-none">
                                    <option value="">Choose year...</option>
                                    @for ($year = date('Y') - 1; $year <= date('Y') + 10; $year++)
                                        <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        {{-- Target --}}
                        <div class="flex-1 min-w-0">
                            <label for="line-performance-target" class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Target (%)</label>
                            <input
                                type="number"
                                name="line-performance-target"
                                id="line-performance-target"
                                value="{{ old('target') }}"
                                placeholder="0.0"
                                required step="0.1" min="0" max="100"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                            >
                        </div>
                        {{-- Actual --}}
                        <div class="flex-1 min-w-0">
                            <label for="line-performance-actual" class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Actual (%)</label>
                            <input
                                type="number"
                                name="line-performance-actual"
                                id="line-performance-actual"
                                value="{{ old('actual') }}"
                                placeholder="0.0"
                                required step="0.1" min="0" max="100"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                            >
                        </div>
                        {{-- Button Submit --}}
                        <div class="shrink-0">
                            <button type="submit"
                                class="flex items-center gap-2 bg-gradient-to-r from-red-600 to-rose-700 hover:brightness-110 text-white font-bold text-sm px-5 py-2.5 rounded-lg shadow-sm shadow-red-200 transition-all duration-200 whitespace-nowrap">
                                SUBMIT RECORD
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- Error Message --}}
                    @if($errors->any())
                        <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-600">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        {{-- ===== DATA TABLE ===== --}}
        <div>
            <div class="flex items-end justify-between mb-3">
                {{-- Title --}}
                <div class="ml-2">
                    <p class="text-xs font-bold tracking-widest text-red-600 uppercase">Performance Data</p>
                    <h2 class="text-xl font-bold text-gray-900">Monthly Records</h2>
                </div>
                <div class="flex items-center gap-2">
                    {{-- Button Filter --}}
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M7 10h10M11 16h2"/>
                        </svg>
                    </button>
                    {{-- Button Export --}}
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                        </svg>
                    </button>
                </div>
            </div>
            {{-- Table --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <table class="w-full text-sm text-left">
                    {{-- Table Header --}}
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Period</th>
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Target (%)</th>
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Actual (%)</th>
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Achievement</th>
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase text-right">Status</th>
                        </tr>
                    </thead>
                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($linePerformances as $item)
                            @php
                                $met = $item->actual >= $item->target;
                                $pct = $item->target > 0 ? round(($item->actual / $item->target) * 100, 1) : 0;
                            @endphp
                            <tr class="hover:bg-red-50/40 transition-colors duration-150 group">
                                {{-- Period --}}
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <div class="font-semibold text-gray-800 text-sm">{{ $item->year }} — {{ $item->month }}</div>
                                    <div class="text-[11px] text-gray-400 mt-0.5">ID: LP-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                {{-- Target --}}
                                <td class="px-5 py-4 text-gray-600 font-medium">
                                    {{ number_format($item->target, 1) }}%
                                </td>
                                {{-- Actual --}}
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold
                                        {{ $met ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ number_format($item->actual, 1) }}%
                                    </span>
                                </td>
                                {{-- Achievement pie chart --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="relative w-10 h-10 shrink-0">
                                            {{-- Donut ring --}}
                                            <div class="w-10 h-10 rounded-full"
                                                 style="background: conic-gradient(
                                                    {{ $met ? '#22c55e' : '#ef4444' }} 0deg,
                                                    {{ $met ? '#22c55e' : '#ef4444' }} {{ min($pct, 100) * 3.6 }}deg,
                                                    #f3f4f6 {{ min($pct, 100) * 3.6 }}deg,
                                                    #f3f4f6 360deg
                                                 );">
                                                {{-- Donut hole (Inner white circle) --}}
                                                <div class="absolute inset-[3px] rounded-full bg-white"></div>
                                            </div>
                                        </div>
                                        {{-- Achievement Percentage --}}
                                        <span class="text-xs font-bold {{ $met ? 'text-green-600' : 'text-red-600' }}">{{ $pct }}%</span>
                                    </div>
                                </td>
                                {{-- Status + actions --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Status --}}
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center {{ $met ? 'bg-green-100' : 'bg-red-100' }}">
                                            @if($met)
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            @endif
                                        </div>
                                        {{-- Actions --}}
                                        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                            {{-- Edit --}}                                            
                                            <a href="javascript:void(0)"
                                               data-modal-open="edit-line-performance-modal-{{ $item->id }}"
                                               class="w-7 h-7 flex items-center justify-center rounded-lg bg-sky-100 text-sky-600 hover:bg-sky-200 transition" title="Edit">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            {{-- Delete --}}
                                            <form action="{{ route('line-performance.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Hapus data {{ $item->month }} {{ $item->year }}?')"
                                                    title="Delete"
                                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {{-- Modal Edit --}}
                            <x-ui.modal id="edit-line-performance-modal-{{ $item->id }}" maxWidth="max-w-lg">
                                <x-forms.edit-line-performance :item="$item" />
                            </x-ui.modal>
                        @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        <span class="text-sm">Belum ada data line performance.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Footer --}}
                <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                    <p class="text-xs text-red-500 font-medium">
                        Showing {{ $linePerformances->firstItem() ?? 0 }}–{{ $linePerformances->lastItem() ?? 0 }} of {{ $linePerformances->total() }} records
                    </p>
                    <div class="flex items-center gap-2">
                        @if ($linePerformances->onFirstPage())
                            <span class="px-4 py-1.5 text-xs font-semibold text-gray-300 border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $linePerformances->previousPageUrl() }}"
                               class="px-4 py-1.5 text-xs font-semibold text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                Previous
                            </a>
                        @endif
                        @if ($linePerformances->hasMorePages())
                            <a href="{{ $linePerformances->nextPageUrl() }}"
                               class="px-4 py-1.5 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-rose-700 rounded-lg hover:brightness-110 shadow-sm shadow-red-200 transition">
                                Next
                            </a>
                        @else
                            <span class="px-4 py-1.5 text-xs font-bold text-white bg-red-300 rounded-lg cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-ui.footer />
</div>
@endsection

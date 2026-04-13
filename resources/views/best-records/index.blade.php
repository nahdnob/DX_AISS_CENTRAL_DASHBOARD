@extends('layouts.system-manager')

@section('content')
<div class="p-4 sm:ml-16 mt-14 transition-all duration-300">
    <div class="p-4 min-h-[calc(100vh-5rem)]">
        {{-- ===== HERO HEADER ===== --}}
        <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">
            {{-- Decorative background --}}
            <div class="absolute right-0 top-0 w-48 h-full bg-gradient-to-l from-red-50 to-transparent pointer-events-none"></div>
            <div class="absolute right-8 top-1/2 -translate-y-1/2 w-24 h-24 rounded-full bg-red-100/40 pointer-events-none"></div>
            <div class="relative flex items-center gap-5 px-6 py-5">
                {{-- Icon --}}
                <div class="shrink-0 w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                    </svg>
                </div>
                {{-- Text --}}
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Best Record</h1>
                    <p class="mt-1 text-sm text-gray-500 max-w-lg leading-relaxed">
                        This is the history of claims that have occurred on the
                        <span class="font-semibold text-red-600">AISS production line</span>.
                        Precision tracking ensures continuous improvement and technical accountability across all industrial operations.
                    </p>
                </div>
            </div>
            {{-- Left red bar accent --}}
            <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-red-500 to-rose-700 rounded-l-2xl"></div>
        </div>
        {{-- ===== OPERATIONS INPUT SECTION ===== --}}
        <div class="mb-6">
            {{-- Title --}}
            <div class="ml-2 mb-3">
                <p class="text-xs font-bold tracking-widest text-red-600 uppercase">Operations Input</p>
                <h2 class="text-xl font-bold text-gray-900">New Claim Entry</h2>
            </div>
            {{-- Form --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <form action="{{ route('best-records.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3 items-end">
                        {{-- Date --}}
                        <div class="flex-1 min-w-0">
                            <label for="date" class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Occurrence Date</label>
                            <input
                                type="date"
                                name="date"
                                id="date"
                                value="{{ old('date') }}"
                                required
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                            >
                        </div>
                        {{-- Claim Description --}}
                        <div class="flex-[2] min-w-0">
                            <label for="claim" class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Claim Description</label>
                            <input
                                type="text"
                                name="claim"
                                id="claim"
                                value="{{ old('claim') }}"
                                placeholder="Specify technical issue..."
                                required
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                            >
                        </div>
                        {{-- Action Taken --}}
                        <div class="flex-[2] min-w-0">
                            <label for="action" class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Action Taken</label>
                            <input
                                type="text"
                                name="action"
                                id="action"
                                value="{{ old('action') }}"
                                placeholder="Resolution status..."
                                required
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                            >
                        </div>
                        {{-- Submit --}}
                        <div class="shrink-0">
                            <button
                                type="submit"
                                class="flex items-center gap-2 bg-gradient-to-r from-red-600 to-rose-700 hover:brightness-110 text-white font-bold text-sm px-5 py-2.5 rounded-lg shadow-sm shadow-red-200 transition-all duration-200 whitespace-nowrap"
                            >
                                SUBMIT RECORD
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>

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
        {{-- ===== AUDIT LOG / CLAIM HISTORY ===== --}}
        <div>
            <div class="flex items-end justify-between mb-3">
                {{-- Title --}}
                <div class="ml-2">
                    <p class="text-xs font-bold tracking-widest text-red-600 uppercase">Audit Log</p>
                    <h2 class="text-xl font-bold text-gray-900">Claim History</h2>
                </div>
                <div class="flex items-center gap-2">
                    {{-- BUtton Filter --}}
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
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Date</th>
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Claim</th>
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase">Action</th>
                            <th class="px-5 py-3 text-[10px] font-bold tracking-widest text-gray-400 uppercase"></th>
                        </tr>
                    </thead>
                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($ncds as $item)
                            <tr class="hover:bg-red-50/40 transition-colors duration-150 group">
                                {{-- Date + ID --}}
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <div class="font-semibold text-gray-800 text-sm">
                                        {{ \Carbon\Carbon::parse($item->date)->format('Y-m-d') }}
                                    </div>
                                    <div class="text-[11px] text-gray-400 mt-0.5">ID: REC-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                {{-- Claim --}}
                                <td class="px-5 py-4 text-gray-600 max-w-xs">
                                    {{ $item->claim }}
                                </td>
                                {{-- Action --}}
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-700">
                                        {{ $item->action }}
                                    </span>
                                </td>
                                {{-- Edit/Delete --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Edit / Delete (visible on hover) --}}
                                        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                            <a
                                                href="javascript:void(0)"
                                                data-modal-open="edit-best-records-modal-{{ $item->id }}"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg bg-sky-100 text-sky-600 hover:bg-sky-200 transition text-xs font-bold"
                                                title="Edit"
                                            >
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('best-records.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Hapus record ini?')"
                                                    title="Delete"
                                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                >
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {{-- Edit Modal --}}
                            <x-ui.modal id="edit-best-records-modal-{{ $item->id }}" maxWidth="max-w-lg">
                                <x-forms.edit-best-record :item="$item" />
                            </x-ui.modal>
                        @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="4" class="px-5 py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <span class="text-sm">Belum ada data claim yang tercatat.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>    
                {{-- Table - Footer --}}
                <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                    {{-- Pagination --}}
                    <p class="text-xs text-red-500 font-medium">
                        Showing {{ $ncds->firstItem() ?? 0 }}–{{ $ncds->lastItem() ?? 0 }} of {{ $ncds->total() }} claims recorded
                    </p>
                    <div class="flex items-center gap-2">
                        {{-- Previous --}}
                        @if ($ncds->onFirstPage())
                            <span class="px-4 py-1.5 text-xs font-semibold text-gray-300 border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $ncds->previousPageUrl() }}"
                               class="px-4 py-1.5 text-xs font-semibold text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                Previous
                            </a>
                        @endif
                        {{-- Next --}}
                        @if ($ncds->hasMorePages())
                            <a href="{{ $ncds->nextPageUrl() }}"
                               class="px-4 py-1.5 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-rose-700 rounded-lg hover:brightness-110 shadow-sm shadow-red-200 transition">
                                Next
                            </a>
                        {{-- Empty State --}}
                        @else
                            <span class="px-4 py-1.5 text-xs font-bold text-white bg-red-300 rounded-lg cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Footer --}}
    <x-ui.footer />
</div>
@endsection

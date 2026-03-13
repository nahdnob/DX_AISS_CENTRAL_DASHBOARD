@extends('layouts.system-manager')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded-base bg-gray-100 b">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-gray-100 b">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-gray-100 b">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                </p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded-base bg-gray-100 b">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-gray-100 b">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                </p>
            </div>
        </div>
        <div class="p-4 min-h-[calc(100vh-8rem)] rounded-base">
            <div class="relative overflow-x-auto white shadow-sm rounded border border-default">
                <div class="p-2">
                    <form>   
                        <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Search</label>
                        <div class="relative w-full max-w-md">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                            </div>
                            <input type="search" id="search" class="block w-full p-3 ps-9 bg-white border border-default text-heading text-sm rounded-xl focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Search" required />
                            <button type="button" class="absolute end-1.5 bottom-1.5 text-white bg-blue-500 hover:bg-blue-700 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-xl text-xs px-3 py-1.5 focus:outline-none">Search</button>
                        </div>
                    </form>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body text-white bg-gray-700 border-b border-default-medium">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Part Number
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Time In
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                QTY In
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Time Out
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                QTY Out
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ $item->part_number }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->firstProductIn['time_in'] 
                                        ? \Carbon\Carbon::parse($item->firstProductIn['time_in'])->format('Y-m-d H:i') 
                                        : '-' 
                                    }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->qty_in ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->lastProductIn->productOut?->time_out
                                        ? \Carbon\Carbon::parse($item->lastProductIn->productOut->time_out)->format('Y-m-d H:i')
                                        : '-'
                                    }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->qty_out ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-center m-2">
                    <x-ui.pagination :paginator="$products" />
                </div>
            </div>
        </div>
        <x-ui.footer />
    </div>
@endsection

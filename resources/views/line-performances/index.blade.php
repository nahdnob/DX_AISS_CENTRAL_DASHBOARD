@extends('layouts.system-manager')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <div class="p-4 min-h-[calc(100vh-8rem)] rounded-base">
            <div class="relative z-0 flex border-2 border-gray-700 rounded shadow-sm mb-4">
                <label class="absolute text-base text-gray-700 duration-300 transform -translate-y-5 scale-75 top-2 z-10 origin-[0]
                            bg-white px-2
                            peer-focus:px-2 peer-focus:text-green-600
                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                            peer-placeholder-shown:top-1/2
                            peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Input
                </label>
                <form action="{{ route('line-performance.store') }}" method="POST" class="flex flex-col w-full">
                    @csrf
                    <div class="flex flex-row mx-2 gap-10">
                        <div class="relative z-0 w-full mt-5 mb-3 group">
                            <select id="line-performance-month" name="line-performance-month" class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-700 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer">
                                <option value="">choose</option>
                                @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                                    <option value="{{ $m }}" {{ old('month') == $m ? 'selected' : '' }}>
                                        {{ $m }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="line-performance-month"
                                class="absolute text-sm text-gray-700 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                        bg-white px-2
                                        peer-focus:px-2 peer-focus:text-green-600
                                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                        peer-placeholder-shown:top-1/2
                                        peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Month
                            </label>
                        </div>
                        <div class="relative z-0 w-full mt-5 mb-3 group">
                            <select id="line-performance-year" name="line-performance-year" class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-700 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer">
                                <option value="">choose</option>
                                @for ($year = date('Y') - 1; $year <= date('Y') + 10; $year++)
                                    <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            <label for="line-performance-year"
                                class="absolute text-sm text-gray-700 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                        bg-white px-2
                                        peer-focus:px-2 peer-focus:text-green-600
                                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                        peer-placeholder-shown:top-1/2
                                        peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Year
                            </label>
                        </div>
                        <div class="relative z-0 w-full mt-5 mb-3 group">
                            <input type="number" name="line-performance-target" id="line-performance-target" value="{{ old('target') }}" placeholder="" class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-700 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" required step="0.1" min="0" max="100">
                            <label for="line-performance-target"
                                class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                        bg-white px-2 ml-1
                                        peer-focus:px-2 peer-focus:text-green-600
                                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                        peer-placeholder-shown:top-1/2
                                        peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Target (%)
                            </label>
                        </div>
                        <div class="relative z-0 w-full mt-5 mb-3 group">
                            <input type="number" name="line-performance-actual" id="line-performance-actual" value="{{ old('actual') }}" placeholder="" class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-700 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" required step="0.1" min="0" max="100">
                            <label for="line-performance-actual"
                                class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                    bg-white px-2 ml-1
                                    peer-focus:px-2 peer-focus:text-green-600
                                    peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                    peer-placeholder-shown:top-1/2
                                    peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Actual (%)
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mb-2 mx-2 gap-2">
                        <button type="submit" class="px-8 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-700">Submit</button>                        
                    </div>
                </form>
            </div>
            <div class="relative overflow-x-auto white shadow-sm rounded border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body text-white bg-gray-700 border-b border-default-medium">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Year - Month
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Target (%)
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Actual (%)
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($linePerformances as $item)
                            <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ $item->year }} - {{ $item->month }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ number_format($item->target, 1) }}
                                </td>
                                <td class="px-6 py-4 {{ $item->target > $item->actual ? 'text-red-600 font-medium' : 'text-green-600 font-medium' }}">
                                    {{ number_format($item->actual, 1) }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="javascript:void(0)" data-modal-open="edit-line-performance-modal-{{ $item->id }}" class="font-medium text-fg-brand hover:underline">Edit</a>
                                </td>
                                <x-ui.modal id="edit-line-performance-modal-{{ $item->id }}" title="Edit Line Performance">
                                    <div class="p-4">
                                        <p class="text-sm text-gray-500">Select a record to edit. {{ $item->id }}</p>
                                    </div>
                                </x-ui.modal>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-center m-2">
                    <x-ui.pagination :paginator="$linePerformances" />
                </div>
            </div>
        </div>
        <x-ui.footer />
    </div>
@endsection

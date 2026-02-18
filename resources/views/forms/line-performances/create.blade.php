<div class="bg-white rounded-lg p-6 shadow-sm">
	{{-- Form - Title --}}
    <h2 class="text-lg font-semibold mb-4 uppercase">Input</h2>
	{{-- Form - Body --}}
    <form id="line-performance-form" action="{{ route('linePerformance.store') }}" method="POST">
        @csrf
        <input type="hidden" id="lp-id" name="id">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                <!-- Input - Month -->
                <div class="relative">
                    <select id="line-performance-month" name="line-performance-month" class="block py-2.5 px-3 w-full text-sm text-gray-500 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer">
                        <option value="">choose</option>
                        @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                            <option value="{{ $m }}" {{ old('month') == $m ? 'selected' : '' }}>
                                {{ $m }}
                            </option>
                        @endforeach
                    </select>
                    <label for="line-performance-month"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                bg-white px-2
                                peer-focus:px-2 peer-focus:text-green-600
                                peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                peer-placeholder-shown:top-1/2
                                peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Month
                    </label>
                </div>
                <!-- Input - Year -->
                <div class="relative">
                    <select id="line-performance-year" name="line-performance-year" class="block py-2.5 px-3 w-full text-sm text-gray-500 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer">
                        <option value="">choose</option>
                        @for ($year = date('Y') - 1; $year <= date('Y') + 10; $year++)
                            <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    <label for="line-performance-year"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                bg-white px-2
                                peer-focus:px-2 peer-focus:text-green-600
                                peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                peer-placeholder-shown:top-1/2
                                peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Year
                    </label>
                </div>
                <!-- Input - Target -->
                <div class="relative">
                    <input type="text" name="line-performance-target" id="line-performance-target" value="{{ old('target') }}" placeholder="" class="block py-2.5 px-3 w-full text-sm text-gray-900 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer">
                    <label for="line-performance-target"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                bg-white px-2 ml-1
                                peer-focus:px-2 peer-focus:text-green-600
                                peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                peer-placeholder-shown:top-1/2
                                peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Target (%)
                    </label>
                </div>
                <!-- Input - Actual -->
                <div class="relative">
                    <input type="text" name="line-performance-actual" id="line-performance-actual" value="{{ old('actual') }}" placeholder="" class="block py-2.5 px-3 w-full text-sm text-gray-900 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer">
                    <label for="line-performance-actual"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                            bg-white px-2 ml-1
                            peer-focus:px-2 peer-focus:text-green-600
                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                            peer-placeholder-shown:top-1/2
                            peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Actual (%)
                    </label>
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <button id="lp-submit" type="submit" class="px-14 py-2 bg-green-500 text-white rounded-lg">Submit</button>
                <button id="lp-delete" type="button" class="px-10 py-2 bg-red-500 text-white rounded-lg hidden">Delete</button>
                <button id="lp-reset" type="button" class="px-3 py-2 border rounded-lg hidden" title="Reset">
                    <svg class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4 m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                    </svg>
                </button>
            </div>
    </form>
	{{-- Line --}}
    <hr class="my-4">
	{{-- Table - Title --}}
    <h3 class="text-md font-semibold mb-4 uppercase">Line Performance Data</h3>
    {{-- Input - Search --}}
    <div class="flex gap-2 mb-3">
        <input
            type="text"
            id="lp-search"
            placeholder="Search..."
            class="border rounded px-3 py-2 w-full"
        >

        <select id="lp-group" class="border rounded px-3 py-2">
            <option value="">No Group</option>
            <option value="month">Group by Month</option>
            <option value="year">Group by Year</option>
            <option value="month_year">Group by Month + Year</option>
        </select>
    </div>

    <div class="overflow-x-auto">
        <div id="line-performance-table-wrapper">
            <table id="line-performance-table" class="w-full text-sm text-left text-gray-700">
                {{-- Table - Header --}}
                <thead class="bg-gray-100 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center">Month</th>
                        <th class="px-4 py-3 text-center">Target</th>
                        <th class="px-4 py-3 text-center">Actual</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                {{-- Table - Body --}}
                <tbody id="line-performance-tbody" class="divide-y">
                    @forelse ($linePerformances as $index => $linePerformance)
                        <tr data-row="{{ $index }}">
                            <td class="px-4 py-3 text-center">{{\Carbon\Carbon::parse($linePerformance->month)->format('M')}} '{{substr($linePerformance->year, -2)}}</td>
                            <td class="px-4 py-3 text-center">{{ $linePerformance->target }}%</td>
                            <td class="px-4 py-3 text-center {{ $linePerformance->actual >= $linePerformance->target ? : 'text-red-500' }}">{{ $linePerformance->actual }}%</td>
                            <td class="px-4 py-3 text-center">
                                <button type="button" onclick="LinePerformanceModal.edit({{ $linePerformance->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{-- Line --}}
            <hr class="mt-1 mb-4">
            <div id="line-performance-pagination" class="mt-4">
                {{ $linePerformances->links() }}
            </div>
        </div>
    </div>
</div>
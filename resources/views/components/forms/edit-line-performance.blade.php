<div class="bg-white p-6 rounded-xl shadow-md max-w-md">
    <h2 class="text-xl font-semibold text-gray-800 mb-5 border-b pb-2">
        Edit Line Performance
    </h2>
    <form action="{{ route('line-performance.update', $item->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <!-- Month -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Month
                </label>
                <select name="month"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition">
                    
                    @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                        <option value="{{ $m }}" {{ $item->month == $m ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Year -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Year
                </label>
                <select name="year"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition">
                    @for ($year = date('Y') - 1; $year <= date('Y') + 10; $year++)
                        <option value="{{ $year }}" {{ $item->year == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <!-- Target -->
        <div class="relative z-0 w-full mt-4 group">
            <input
                type="number"
                name="target"
                id="target-{{ $item->id }}"
                value="{{ old('target', $item->target) }}"
                placeholder=" "
                step="0.1"
                min="0"
                max="100"
                required
                class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-teal-500 peer">
            <label for="target-{{ $item->id }}"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                bg-white px-2 ml-1
                peer-focus:text-teal-500
                peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                peer-placeholder-shown:top-1/2
                peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4"
            >
                Target (%)
            </label>
        </div>
        <!-- Actual -->
        <div class="relative z-0 w-full mt-4 group">
            <input
                type="number"
                name="actual"
                id="actual-{{ $item->id }}"
                value="{{ old('actual', $item->actual) }}"
                placeholder=" "
                step="0.1"
                min="0"
                max="100"
                required
                class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-teal-500 peer"
            >
            <label for="actual-{{ $item->id }}"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                bg-white px-2 ml-1
                peer-focus:text-teal-500
                peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                peer-placeholder-shown:top-1/2
                peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4"
            >
                Actual (%)
            </label>
        </div>
        <!-- Buttons -->
        <div class="flex justify-end pt-3 gap-2">
            <button
                type="button"
                data-modal-close="edit-line-performance-modal-{{ $item->id }}"
                class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded-lg transition">
                Cancel
            </button>
            <button
                type="submit"
                class="px-4 py-2 text-sm text-white bg-teal-500 hover:bg-teal-600 rounded-lg shadow-sm transition">
                Update
            </button>
        </div>
    </form>
</div>
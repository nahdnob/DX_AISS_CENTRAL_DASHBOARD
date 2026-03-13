<div class="bg-white p-6 rounded-xl shadow-md max-w-md">
    <h2 class="text-xl font-semibold text-gray-800 mb-5 border-b pb-2">
        Edit Line Performance
    </h2>
    <form action="{{ route('best-records.update', $item->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <!-- Date -->
        <div class="relative z-0 w-full mt-4 group">
            <input
                type="date"
                name="date"
                id="date-{{ $item->id }}"
                value="{{ old('date', $item->date) }}"
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
        <!-- Claim -->
        <div class="relative z-0 w-full mt-4 group">
            <input
                type="text"
                name="claim"
                id="claim-{{ $item->id }}"
                value="{{ old('claim', $item->claim) }}"
                placeholder=" "
                step="0.1"
                min="0"
                max="100"
                required
                class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-teal-500 peer">
            <label for="claim-{{ $item->id }}"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                bg-white px-2 ml-1
                peer-focus:text-teal-500
                peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                peer-placeholder-shown:top-1/2
                peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4"
            >
                Claim
            </label>
        </div>
        <!-- Action -->
        <div class="relative z-0 w-full mt-4 group">
            <input
                type="text"
                name="action"
                id="action-{{ $item->id }}"
                value="{{ old('action', $item->action) }}"
                placeholder=" "
                step="0.1"
                min="0"
                max="100"
                required
                class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-teal-500 peer"
            >
            <label for="action-{{ $item->id }}"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                bg-white px-2 ml-1
                peer-focus:text-teal-500
                peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                peer-placeholder-shown:top-1/2
                peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4"
            >
                Action
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
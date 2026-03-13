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
                <form action="{{ route('best-records.store') }}" method="POST" class="flex flex-col w-full">
                    @csrf
                    <div class="flex flex-row mx-2 gap-10">
                        <div class="relative z-0 w-full mt-5 mb-3 group">
                            <input type="date"
                                name="date"
                                id="date"
                                value="{{ old('date') }}"
                                placeholder=""
                                class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-700 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" required step="0.1" min="0" max="100">
                            <label for="date"
                                class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                        bg-white px-2 ml-1
                                        peer-focus:px-2 peer-focus:text-green-600
                                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                        peer-placeholder-shown:top-1/2
                                        peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Date
                            </label>
                        </div>
                        <div class="relative z-0 w-full mt-5 mb-3 group">
                            <input type="text"
                                name="claim"
                                id="claim"
                                value="{{ old('claim') }}"
                                placeholder=""
                                class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-700 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" required step="0.1" min="0" max="100">
                            <label for="claim"
                                class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                        bg-white px-2 ml-1
                                        peer-focus:px-2 peer-focus:text-green-600
                                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                        peer-placeholder-shown:top-1/2
                                        peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Claim
                            </label>
                        </div>
                        <div class="relative z-0 w-full mt-5 mb-3 group">
                            <input type="text"
                                name="action"
                                id="action"
                                value="{{ old('action') }}"
                                placeholder=""
                                class="block py-2.5 px-3 w-full text-sm text-gray-700 bg-transparent border border-gray-700 rounded-lg appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" required step="0.1" min="0" max="100">
                            <label for="action"
                                class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
                                        bg-white px-2 ml-1
                                        peer-focus:px-2 peer-focus:text-green-600
                                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                        peer-placeholder-shown:top-1/2
                                        peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">Action
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
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Claim
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Action
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ncds as $item)
                            <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->claim }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->action }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a  href="javascript:void(0)"
                                        data-modal-open="edit-best-records-modal-{{ $item->id }}"
                                        class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-700 transition"
                                    >
                                        Edit
                                    </a>
                                    <form action="{{ route('best-records.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete data for {{ $item->month }} {{ $item->year }}?')"
                                            class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-700 transition ms-2">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <x-ui.modal id="edit-best-records-modal-{{ $item->id }}" class="h-full" maxWidth="max-w-lg">
                                    <x-forms.edit-best-record :item="$item" />
                                </x-ui.modal>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-center m-2">
                    <x-ui.pagination :paginator="$ncds" />
                </div>
            </div>
        </div>
        <x-ui.footer />
    </div>
@endsection

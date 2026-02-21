@props([
    'name',
    'email' => null,
    'npk',
    'image',
    'verified' => false,
])

<div class="w-[340px] bg-white dark:bg-gray-800
            rounded-2xl shadow-xl
            p-6 space-y-6">

    {{-- Photo --}}
    <div class="flex justify-center">
        <div class="w-36 h-36 rounded-xl overflow-hidden shadow-md">
            <img src="{{ $image }}"
                 alt="{{ $name }}"
                 class="w-full h-full object-cover">
        </div>
    </div>

    {{-- Name & Title --}}
    <div class="text-center space-y-1">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white
                   flex items-center justify-center gap-1">
            {{ $name }}

            @if($verified)
                <svg class="w-4 h-4 text-green-500"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor"
                     viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            @endif
        </h2>

        @if($npk)
             <p class="text-sm text-gray-500 dark:text-gray-400">
                NPK: {{ $npk }}
            </p>
        @endif
    </div>

    {{-- Divider --}}
    <div class="border-t border-gray-200 dark:border-gray-700"></div>

    {{-- Biodata --}}
    <dl class="space-y-4 text-sm">

        @if($email)
        <div>
            <dt class="text-gray-500 dark:text-gray-400">Email</dt>
            <dd class="font-medium text-gray-800 dark:text-white break-all">
                {{ $email }}
            </dd>
        </div>
        @endif

        <div>
            <dt class="text-gray-500 dark:text-gray-400">Phone</dt>
            <dd class="font-medium text-gray-800 dark:text-white">
                085123123123
            </dd>
        </div>

    </dl>

</div>
<div class="flex w-full min-h-[440px] max-w-3xl mx-auto rounded-2xl overflow-hidden shadow-2xl">

    {{-- Left Panel: DENSO Background Image --}}
    <div class="relative hidden sm:flex w-5/12 flex-col justify-between p-1 overflow-hidden"
         style="background: url('{{ asset('assets/images/denso-background.png') }}') center center / cover no-repeat; background-color: white;">

        {{-- DENSO Logo --}}
        <div class="relative z-10">
            <img src="{{ asset('img/denso_logo.png') }}"
                 class="h-16 w-auto object-contain" alt="DENSO">
        </div>

        {{-- Footer --}}
        <div class="relative z-10 pl-2 pb-3">
            <p class="text-[9px] text-gray-400 tracking-wide">
                © {{ date('Y') }} DENSO CORPORATION
            </p>
        </div>
    </div>

    {{-- Right Panel: Login Form --}}
    <div class="flex-1 bg-white flex items-center justify-center px-8 py-10 border-l border-gray-100">
        <form method="POST" action="{{ route('login') }}" class="w-full space-y-5">
            @csrf

            {{-- Header --}}
            <div class="text-center pb-1">
                <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-rose-900 mb-1 uppercase">
                    Welcome
                </h1>
                <p class="text-sm text-gray-400 font-medium">Sign in to your AISS account</p>
            </div>

            {{-- NPK --}}
            <div>
                <label for="npk" class="block mb-2 text-sm font-semibold text-gray-700">NPK</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-sky-500 transition-colors"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" name="npk" id="npk"
                        class="bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 block w-full pl-11 p-3.5 transition-all duration-200 placeholder-gray-400 font-medium"
                        placeholder="e.g. 219XXXX" required>
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-sky-500 transition-colors"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 block w-full pl-11 p-3.5 transition-all duration-200 placeholder-gray-400 font-medium tracking-widest"
                        placeholder="••••••••" required>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full text-white bg-gradient-to-r from-red-600 to-rose-900 hover:from-red-700 hover:to-rose-950 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-xl text-md px-5 py-3.5 text-center transform transition-all active:scale-[0.98] shadow-lg shadow-red-500/30">
                Sign In
            </button>
        </form>
    </div>

</div>
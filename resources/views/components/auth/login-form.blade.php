<form method="POST" action="{{ route('login') }}" class="w-[90vw] max-w-md bg-white rounded-xl shadow-xl p-6 space-y-4">
    @csrf

    <h1 class="text-xl font-bold text-gray-900 md:text-2xl dark:text-white">
        Sign in to your account
    </h1>

    <div>
        <label for="npk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Your NPK
        </label>
        <input type="text" name="npk" id="npk"
            class="bg-gray-50 border border-sky-300 text-gray-900 rounded-lg 
            focus:ring-sky-400 focus:border-sky-400 
            block w-full p-2.5 
            dark:bg-gray-700 dark:border-sky-500 
            dark:text-white"
            placeholder="219XXXX" required>
    </div>

    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Password
        </label>
        <input type="password" name="password" id="password"
            class="bg-gray-50 border border-sky-300 text-gray-900 rounded-lg 
            focus:ring-sky-400 focus:border-sky-400 
            block w-full p-2.5 
            dark:bg-gray-700 dark:border-sky-500 
            dark:text-white"
            placeholder="••••••••" required>
    </div>

    <button type="submit"
        class="w-full text-white bg-sky-400 hover:bg-sky-500 
        focus:ring-4 focus:outline-none focus:ring-sky-300 
        font-medium rounded-lg text-sm px-5 py-2.5 text-center 
        dark:bg-sky-500 dark:hover:bg-sky-600">
        Sign in
    </button>

    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        Don’t have an account yet? 
        <a href="#" class="font-medium text-sky-500 hover:underline dark:text-sky-400">
            Sign up
        </a>
    </p>
</form>
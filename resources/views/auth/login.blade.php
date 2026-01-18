<x-guest-layout>
    <div>
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Sign in to your account
        </h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">
            Not a member?
            <a href="{{ route('register') }}" class="font-semibold text-green-600 hover:text-green-500">Start your free
                trial</a>
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6 mt-8">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required
                    value="{{ old('email') }}" autofocus
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-600">
                <label for="remember_me" class="ml-3 block text-sm leading-6 text-gray-900">Remember me</label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm leading-6">
                    <a href="{{ route('password.request') }}"
                        class="font-semibold text-green-600 hover:text-green-500">Forgot password?</a>
                </div>
            @endif
        </div>

        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Sign
                in</button>
        </div>
    </form>
</x-guest-layout>

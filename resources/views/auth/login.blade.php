<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Welcome back 👋
        </h1>
        <p class="mt-1 text-sm text-gray-600">
            Sign in using your email and password.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-primary focus:ring-primary/30"
                    name="remember">
                <span class="text-sm text-gray-700">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-primary hover:text-primary-700"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5
                   text-sm font-semibold text-white shadow-sm hover:bg-primary-600
                   focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
            {{ __('Log in') }}
        </button>

        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600">
                Don’t have an account?
                <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-primary-700">
                    Register
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>

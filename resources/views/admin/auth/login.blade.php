<x-guest-layout>
    <!-- Heading -->
    

    <!-- Logo di dalam form (opsional, bisa dihapus kalau tidak perlu) -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Admin" style="width: 100px; height: auto mt-4; ">
    </div>

    <h2 class="text-xl font-bold text-center text-gray-800 mb-4">Login Admin</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" class="text-black"  />

    <!-- Login Form -->
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-black" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-black" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <!-- Submit dan Lupa Password -->
        <div class="flex items-center justify-between mt-4">
            <!-- Link ke pendaftaran -->
            <div class="mt-4 text-center">
                <a class="text-sm text-gray-600 hover:underline" href="{{ route('admin.register') }}">
                    Belum punya akun? <strong>Daftar di sini</strong>
                </a>
            </div>

            <x-primary-button class="ml-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        
    </form>
</x-guest-layout>

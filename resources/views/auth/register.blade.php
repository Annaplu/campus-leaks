<x-guest-layout>

    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Admin" style="width: 100px; height: auto mt-4; ">
    </div>
    <h4 class="text-xl font-bold text-center text-gray-800 mb-4">User Register</h4>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-800"  />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-800"  />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Identifier (NIM/NIP) -->
        <div class="mt-4">
            <x-input-label for="identifier" :value="__('NIM / NIP')" class="text-gray-800" />
            <x-text-input id="identifier" class="block mt-1 w-full" type="text" name="identifier" :value="old('identifier')" required />
            <x-input-error :messages="$errors->get('identifier')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <label for="role">Peran</label>
            <select name="role" id="role" onchange="toggleCustomRole(this)">
                <option value="">-- Pilih Peran --</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="kantin">Penjaga Kantin</option>
                <option value="ob">OB</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <!-- Custom Role Input (Hanya muncul kalau 'lainnya') -->
        <div id="custom-role-field" class="mt-4 hidden">
            <label for="custom_role">Tulis Peran Anda</label>
            <input type="text" name="custom_role" id="custom_role" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-800"  />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-800"  />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    function toggleCustomRole(select) {
        const customRoleField = document.getElementById('custom-role-field');
        if (select.value === 'lainnya') {
            customRoleField.classList.remove('hidden');
        } else {
            customRoleField.classList.add('hidden');
        }
    }

    // Trigger on reload jika validasi gagal dan user pilih "lainnya"
    document.addEventListener('DOMContentLoaded', function () {
        toggleCustomRole(document.getElementById('role'));
    });
</script>

<x-guest-layout>
    <div id="app">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" required autofocus/>
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="role" :value="__('Pilih Peran')" />
                <select name="role" id="role" class="block mt-1 w-full">
                    <option value="0">Admin</option>
                    <option value="1">Customer</option>
                </select>
            </div>

            <!-- Email Address -->
            <!-- <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div> -->

            <!-- Address -->
            <div class="mt-4" id="seen1">
                <x-input-label for="address" :value="__('Alamat')" />
                <textarea name="address" id="address" class="block mt-1 w-full" autofocus></textarea>
            </div>

            <!-- Phone -->
            <div class="mt-4" id="seen2">
                <x-input-label for="phone" :value="__('Nomor Telepon')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" autofocus/>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Sim Number -->
            <div class="mt-4" id="seen3">
                <x-input-label for="sim_number" :value="__('Nomor SIM')" />
                <x-text-input id="sim_number" class="block mt-1 w-full" type="text" name="sim_number" autofocus/>
                <x-input-error :messages="$errors->get('sim_number')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Kata Sandi')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
        
</x-guest-layout>

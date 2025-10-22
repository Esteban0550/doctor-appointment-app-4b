<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
<<<<<<< HEAD
                <x-label for="email" value="Email" />
=======
                <x-label for="email" value="{{ __('Email') }}" />
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
<<<<<<< HEAD
                <x-label for="password" value="Contraseña" />
=======
                <x-label for="password" value="{{ __('Password') }}" />
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
<<<<<<< HEAD
                    <span class="ms-2 text-sm text-gray-600">Mantener sesión activa</span>
=======
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
<<<<<<< HEAD
                        ¿Olvidó su contraseña?
                    </a>
                @endif

                <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Iniciar Sesión
                </button>
=======
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

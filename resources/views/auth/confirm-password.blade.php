<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <img class="logo-img h-24 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo Desa">
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="card-guest bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-200">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Ini adalah area aman dari aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button class="bg-green-600 hover:bg-green-700 focus:ring-green-500">
                            {{ __('Konfirmasi') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
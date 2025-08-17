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
                    {{ __('Lupa password Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" 
                                    :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button class="bg-green-600 hover:bg-green-700 focus:ring-green-500">
                            {{ __('Kirim Tautan Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
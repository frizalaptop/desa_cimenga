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
                    {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang baru.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <x-primary-button class="bg-green-600 hover:bg-green-700 focus:ring-green-500">
                                {{ __('Kirim Ulang Email Verifikasi') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            {{ __('Keluar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 
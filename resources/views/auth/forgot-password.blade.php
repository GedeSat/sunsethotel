<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-8">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">
                Forgot Password
            </h2>

            <p class="text-sm text-gray-600 text-center mb-6">
                Masukkan email kamu dan kami akan mengirimkan link reset password.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address
                    </label>

                    <input id="email" type="email" name="email"
                        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('email') }}" required autofocus>

                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Submit button -->
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-semibold transition">
                    Send Password Reset Link
                </button>

                <!-- Back to login -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                        &larr; Kembali ke Login
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>

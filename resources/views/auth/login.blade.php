<x-guest-layout>

    <style>
        body {
            background: white !important;
            min-height: 100vh;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 22px;
            border: 1px solid rgba(200, 200, 200, 0.4);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .input-style {
            background: #f7f7f7 !important;
            border: 1px solid #dcdcdc !important;
            color: #333 !important;
            border-radius: 10px !important;
        }

        .input-style::placeholder {
            color: #888;
        }

        .btn-gradient {
            background: linear-gradient(90deg,#4c6ef5,#3bc9db);
            color: white;
            border-radius: 10px;
        }

        .btn-social {
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 10px;
            color: #555;
        }
    </style>

    <div class="flex items-center justify-center min-h-screen p-4">

        <div class="w-full max-w-md card-glass px-10 py-8">

            <h2 class="text-3xl text-gray-900 font-bold text-center">Welcome Back</h2>
            <p class="text-center text-gray-600 mb-6">Sign in to your account</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-gray-700" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="text-gray-900" />
                    <x-text-input id="email"
                        class="block mt-1 w-full input-style"
                        type="email" name="email"
                        :value="old('email')"
                        placeholder="Email Address"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-900" />
                    <x-text-input id="password"
                        class="block mt-1 w-full input-style"
                        type="password"
                        name="password"
                        placeholder="Password"
                        required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Remember / Forgot -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-400 text-indigo-600" name="remember">
                        <span class="ms-2 text-sm text-gray-700">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800"
                            href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button class="w-full py-2 mt-6 font-semibold btn-gradient hover:opacity-90 transition">
                    Sign In
                </button>

                <!-- Divider -->
                <div class="flex items-center my-6">
                    <div class="flex-grow h-px bg-gray-300"></div>
                    <span class="px-3 text-gray-500">or continue with</span>
                    <div class="flex-grow h-px bg-gray-300"></div>
                </div>

                <!-- Social Login Buttons -->
                <div class="flex gap-3 mb-4">
                    <button type="button" class="w-1/2 py-2 btn-social">
                        🌐 Google
                    </button>
                    <button type="button" class="w-1/2 py-2 btn-social">
                        🐱‍💻 GitHub
                    </button>
                </div>

            </form>

            <p class="text-center text-gray-700 mt-4">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800">
                    Sign up
                </a>
            </p>

        </div>

    </div>
</x-guest-layout>

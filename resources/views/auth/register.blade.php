<x-guest-layout>

    <style>
        /* Light-mode styles (safe on white background) */
        body { background: white !important; }

        .card-light {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #eef1f4;
            box-shadow: 0 8px 24px rgba(16,24,40,0.06);
        }

        .input-light {
            background: #f8fafc !important;
            border: 1px solid #e6e9ef !important;
            color: #111827 !important;
            border-radius: 10px !important;
            padding: .625rem .75rem; /* 10px 12px */
        }

        .input-light::placeholder { color: #9aa4b2 !important; }

        .btn-primary {
            background: linear-gradient(90deg,#4c6ef5,#3bc9db);
            color: white;
            border-radius: 10px;
            padding: .65rem 1rem;
            font-weight: 600;
        }

        .small-link { color: #4c6ef5; }
    </style>

    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md card-light p-8">

            <!-- small back link -->
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline mb-3 inline-block">
                &larr; Back to Login
            </a>

            <h2 class="text-2xl font-semibold text-gray-900 text-center mt-2">Create Account</h2>
            <p class="text-sm text-gray-600 text-center mb-6">Register a new account</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <!-- force kelas untuk override Tailwind defaults -->
                    <x-text-input id="name" class="mt-1 w-full input-light"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Full name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <x-text-input id="email" class="mt-1 w-full input-light"
                        type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@example.com" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <x-text-input id="password" class="mt-1 w-full input-light"
                        type="password" name="password" required autocomplete="new-password" placeholder="Create password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Confirm -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <x-text-input id="password_confirmation" class="mt-1 w-full input-light"
                        type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Submit -->
                <div class="mt-6">
                    <button type="submit" class="w-full btn-primary hover:opacity-95 transition">
                        Create Account
                    </button>
                </div>

                <!-- footer -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Already registered?
                    <a href="{{ route('login') }}" class="small-link hover:underline">Sign In</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>

<x-auth.layouts>
    <x-slot:title>{{ $title ?? 'Forgot Password' }}</x-slot:title>

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>

            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    @error('email')
                        <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600">Back to Login</a>

                    <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                        Send Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-auth.layouts>

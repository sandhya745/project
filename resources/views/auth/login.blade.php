@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-200 p-6">

    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- LEFT PANEL -->
        <div class="bg-gradient-to-br from-indigo-600 to-blue-700 text-white p-12 flex flex-col justify-between">

            <div>
                <h2 class="text-lg font-semibold tracking-widest uppercase">
                    BOOKHUB
                </h2>

                <h1 class="text-4xl font-bold mt-16 leading-snug">
                    Start your journey with us.
                </h1>

                <p class="mt-6 text-blue-100 text-lg">
                    Discover the world’s best novels, authors and stories in one place.
                </p>
            </div>

            <!-- Testimonial Card -->
            <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl mt-16 shadow-lg">
                <p class="text-sm">
                    Simply unbelievable! I am really satisfied with my reading experience.
                    This platform is absolutely wonderful!
                </p>

                <div class="mt-4 flex items-center">
                    <div class="w-10 h-10 bg-white rounded-full mr-3"></div>
                    <div>
                        <p class="font-semibold text-sm">Happy Reader</p>
                        <p class="text-xs text-blue-200">Book Lover</p>
                    </div>
                </div>

                <div class="flex justify-center mt-4 space-x-2">
                    <div class="w-2 h-2 bg-white rounded-full opacity-70"></div>
                    <div class="w-2 h-2 bg-white rounded-full opacity-40"></div>
                    <div class="w-2 h-2 bg-white rounded-full opacity-40"></div>
                </div>
            </div>

        </div>


        <!-- RIGHT PANEL -->
        <div class="p-14">

            <h2 class="text-3xl font-bold text-gray-800">
                Login
            </h2>

            <p class="text-gray-500 mt-1 mb-8">
                Welcome Back!
            </p>

            <!-- Error Display -->
            @if ($errors->any())
                <div class="mb-4 text-red-500 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                           placeholder="example@gmail.com">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Password</label>
                    <input type="password"
                           name="password"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                           placeholder="minimum 6 characters">
                </div>

                <!-- Remember + Forgot -->
                <div class="flex justify-between items-center mb-8 text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>

                    <a href="#" class="text-indigo-600 hover:underline">
                        Forgot Password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition duration-300 shadow-md">
                    Login
                </button>

                <!-- Register -->
                <p class="text-center text-sm text-gray-500 mt-6">
                    Not registered yet?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">
                        Create an Account
                    </a>
                </p>

            </form>

        </div>
    </div>

</div>
@endsection

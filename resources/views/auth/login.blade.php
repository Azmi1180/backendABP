@extends('layouts.app') {{-- Assuming you have a main layout --}}

@section('title', 'Login')

@section('content')
<div class="flex min-h-[calc(100vh-5rem)] items-center justify-center bg-white font-sans"> {{-- Adjusted min-h for content area --}}
    <div class="flex flex-col md:flex-row max-w-6xl w-full h-auto md:h-[600px] shadow-xl rounded-lg overflow-hidden">
        <!-- Left Section - Illustration -->
        <div class="hidden md:flex flex-1 flex-col justify-center items-center px-8 py-12 bg-gradient-to-br from-blue-600 to-[#003479] text-white">
            {{-- You'll need to place your image in public/assets or use an asset helper --}}
            <img
                src="{{ asset('assets/foto2.png') }}" {{-- Replace with your actual image path --}}
                alt="Megaphone Illustration"
                class="w-[260px] h-auto mb-8"
            />
            <p class="italic font-semibold text-center text-lg">
                "Stay informed, stay ahead. With Instannews,<br />
                get the news you need, the way you want."
            </p>
        </div>

        <!-- Right Section - Form -->
        <div class="flex-1 flex flex-col justify-center px-8 sm:px-12 py-12 bg-white">
            <div class="w-full max-w-md mx-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-[#00569C] mb-1 text-center">
                    Hello, welcome back!
                </h1>
                <p class="text-sm text-gray-600 mb-6 text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-[#00569C] font-semibold hover:underline">
                        Sign Up Now
                    </a>
                </p>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                 @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium mb-1 text-gray-700">
                            Username
                        </label>
                        <input
                            type="text" {{-- Changed from email --}}
                            id="username"
                            name="username" {{-- Name attribute is crucial for form submission --}}
                            placeholder="Enter your username"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-sm"
                            value="{{ old('username') }}"
                            required
                            autofocus
                        />
                    </div>

                    <div class="mb-8">
                        <label for="password" class="block text-sm font-medium mb-1 text-gray-700">
                            Password
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            required
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#003479] hover:bg-blue-800 text-white py-3 rounded-lg font-semibold shadow-md text-sm transition duration-150 ease-in-out"
                    >
                        Log In
                    </button>

                    <p class="text-xs text-center text-gray-500 mt-6">
                        By continuing, you agree to our
                        <a href="#" class="text-blue-700 hover:underline">Terms of Use</a>
                        and
                        <a href="#" class="text-blue-700 hover:underline">Privacy Policy</a>.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center bg-white font-sans">
    <div class="w-full max-w-6xl flex flex-col md:flex-row shadow-xl rounded-lg overflow-hidden">
        <!-- Left Section - Illustration -->
        <div class="hidden md:flex flex-1 flex-col justify-center items-center px-8 py-12 bg-gradient-to-br from-blue-50 to-indigo-100">
            <img
                src="{{ asset('assets/signup.png') }}" {{-- Replace with your actual image path --}}
                alt="Signup Illustration"
                class="w-3/5 mb-10 max-w-xs"
            />
            <p class="text-center text-[#073E81] italic text-lg font-medium leading-relaxed">
                "Sign up and stay ahead. With Instannews, customize<br />
                your news experience and stay informed on your<br />
                terms."
            </p>
        </div>

        <!-- Right Section - Form -->
        <div class="flex-1 flex flex-col justify-center px-8 sm:px-12 py-12 bg-white">
            <div class="max-w-md w-full mx-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-[#00569C] mb-2 text-center">
                    Get Started with Instannews!
                </h1>
                <p class="text-sm text-gray-600 mb-6 text-center">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#00569C] font-semibold hover:underline">
                        Log in now
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

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    {{-- Full Name field was in React, but your backend only has username.
                         If you want Full Name, add it to migration, model, and AuthController.
                    <div class="mb-4">
                        <label for="name" class="block font-medium mb-1 text-gray-700">Full Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter your full name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            value="{{ old('name') }}"
                            required
                        />
                    </div>
                    --}}
                    <div class="mb-4">
                        <label for="username" class="block font-medium mb-1 text-gray-700">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Choose a username"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            value="{{ old('username') }}"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block font-medium mb-1 text-gray-700">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password (min. 6 characters)"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        />
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block font-medium mb-1 text-gray-700">Confirm Password</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm your password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#003479] hover:bg-blue-800 text-white py-3 rounded-lg font-semibold shadow-md transition duration-150 ease-in-out"
                    >
                        Create Account
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
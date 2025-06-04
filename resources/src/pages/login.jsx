// src/pages/login.jsx
import React, { useState } from "react";
import { useNavigate } from 'react-router-dom'; // For navigation
import megaphoneLogo from '../assets/foto2.png';
import { loginUser } from '../services/authService'; // Import the service

const { login } = useAuth();

export default function Login() {
    const [username, setUsername] = useState(''); // Changed from email to username
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        try {
            const response = await loginUser({ username, password });
            console.log('Login successful:', response.data);
            // TODO: Store user data (e.g., in context or global state)
            // For now, just navigate to home
            navigate('/home');
        } catch (err) {
            console.error('Login failed:', err.response?.data || err.message);
            setError(err.response?.data?.message || 'Login failed. Please check your credentials.');
            if (err.response?.data?.errors) {
                // Handle specific validation errors if your backend sends them
                const specificErrors = Object.values(err.response.data.errors).flat().join(' ');
                setError(specificErrors);
            }
        }
    };

    return (
        <div className="flex min-h-screen items-center justify-center bg-white font-sans">
            <div className="flex flex-col md:flex-row max-w-6xl w-full h-auto md:h-[600px]">
                {/* Left Section */}
                <div className="hidden md:flex flex-1 flex-col justify-center items-center px-8 py-12">
                    {/* ... (image and quote) ... */}
                </div>

                {/* Right Section */}
                <div className="flex-1 flex flex-col justify-center px-8 py-12">
                    <div className="w-full max-w-md mx-auto">
                        <h1 className="text-2xl md:text-3xl font-bold text-[#00569C] mb-1 text-center">
                            Hello, welcome back!
                        </h1>
                        <p className="text-sm text-gray-600 mb-6 text-center">
                            Don't have an account?{" "} {/* Changed link */}
                            <a href="/signup" className="text-[#00569C] font-semibold hover:underline">
                                Sign Up Now
                            </a>
                        </p>

                        {error && <p className="text-red-500 text-sm text-center mb-4">{error}</p>}

                        <form onSubmit={handleSubmit}>
                            <div className="mb-4">
                                <label htmlFor="username" className="block text-sm font-medium mb-1">
                                    Username {/* Changed from Email */}
                                </label>
                                <input
                                    type="text" // Changed from email
                                    id="username"
                                    placeholder="Enter your username" // Changed placeholder
                                    className="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-800 placeholder-gray-500 text-sm"
                                    value={username}
                                    onChange={(e) => setUsername(e.target.value)}
                                    required
                                />
                            </div>

                            <div className="mb-10">
                                <label htmlFor="password" className="block text-sm font-medium mb-1">
                                    Password
                                </label>
                                <input
                                    type="password"
                                    id="password"
                                    placeholder="Enter your password"
                                    className="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:border-blue-800 text-sm"
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                    required
                                />
                            </div>

                            <button
                                type="submit"
                                className="w-full bg-blue-900 hover:bg-blue-950 text-white py-3 rounded-lg font-semibold shadow-md text-sm"
                            >
                                Log In {/* Changed text */}
                            </button>
                            {/* ... (terms and policy) ... */}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}
// src/pages/signUp.jsx
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import signupLogo from '../assets/signup.png';
import { registerUser } from '../services/authService'; // Import

const { login } = useAuth();

export default function SignUp() {
    const [username, setUsername] = useState(''); // Use username
    // const [fullname, setFullname] = useState(''); // Your backend doesn't have fullname
    const [password, setPassword] = useState('');
    const [passwordConfirmation, setPasswordConfirmation] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        if (password !== passwordConfirmation) {
            setError("Passwords do not match.");
            return;
        }
        try {
            const response = await registerUser({
                username,
                password,
                password_confirmation: passwordConfirmation
            });
            console.log('Registration successful:', response.data);
            // TODO: Store user data and/or log them in automatically
            navigate('/home'); // Or to login page: navigate('/login');
        } catch (err) {
            console.error('Registration failed:', err.response?.data || err.message);
            let errorMessage = err.response?.data?.message || 'Registration failed. Please try again.';
            if (err.response?.data?.errors) {
                const fieldErrors = Object.values(err.response.data.errors).flat().join(' ');
                errorMessage = fieldErrors;
            }
            setError(errorMessage);
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-white font-sans">
            <div className="w-full max-w-6xl flex flex-col md:flex-row">
                <div className="flex-1 flex flex-col justify-center items-center px-8 py-12">
                  <img
                    src={signupLogo}
                    alt="Signup Illustration"
                    className="w-3/5 mb-10"
                  />
                  <p className="text-center text-[#073E81] italic text-lg font-medium leading-relaxed">
                    "Sign up and stay ahead. With Instannews, customize<br />
                    your news experience and stay informed on your<br />
                    terms."
                  </p>
                </div>
                <div className="flex-1 flex flex-col justify-center px-8 py-12">
                    <div className="max-w-md w-full mx-auto">
                        <h1 className="text-3xl font-bold text-[#00569C] mb-2 text-center">
                            Get Started with Instannews!
                        </h1>
                        <p className="text-sm text-gray-600 mb-6 text-center">
                            Already have an account?{' '}
                            <a href="/login" className="text-[#00569C] font-semibold">
                                Log in now
                            </a>
                        </p>

                        {error && <p className="text-red-500 text-sm text-center mb-4">{error}</p>}

                        <form onSubmit={handleSubmit}>
                            <div className="mb-4">
                                <label htmlFor="username" className="block font-medium mb-1">
                                    Username {/* Changed from Full Name/Email */}
                                </label>
                                <input
                                    type="text"
                                    id="username"
                                    placeholder="Choose a username"
                                    className="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:border-[#0047AB]"
                                    value={username}
                                    onChange={(e) => setUsername(e.target.value)}
                                    required
                                />
                            </div>

                            {/* Remove Email field if username is the primary identifier */}

                            <div className="mb-4"> {/* Adjusted margin */}
                                <label htmlFor="password" className="block font-medium mb-1">
                                    Password
                                </label>
                                <input
                                    type="password"
                                    id="password"
                                    placeholder="Enter your password"
                                    className="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:border-[#0047AB]"
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                    required
                                />
                            </div>

                            <div className="mb-6">
                                <label htmlFor="password_confirmation" className="block font-medium mb-1">
                                    Confirm Password
                                </label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    placeholder="Confirm your password"
                                    className="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:border-[#0047AB]"
                                    value={passwordConfirmation}
                                    onChange={(e) => setPasswordConfirmation(e.target.value)}
                                    required
                                />
                            </div>

                            <button
                                type="submit"
                                className="w-full bg-[#003380] hover:bg-[#002266] text-white py-3 rounded-lg font-semibold shadow-md"
                            >
                                Create Account {/* Changed text */}
                            </button>
                            <p className="text-xs text-center text-gray-500 mt-6">
                              By continuing, you agree to our{' '}
                              <a href="#" className="text-[#0047AB] underline">
                                Terms of Use
                              </a>{' '}
                              and{' '}
                              <a href="#" className="text-[#0047AB] underline">
                                Privacy Policy
                              </a>
                              .
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}
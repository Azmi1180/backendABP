// src/context/AuthContext.jsx
import React, { createContext, useState, useEffect, useContext } from 'react';
import { fetchCurrentUser, logoutUser as apiLogout } from '../services/authService'; // Assuming logoutUser is in authService

const AuthContext = createContext(null);

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [loading, setLoading] = useState(true); // To handle initial user fetch

    useEffect(() => {
        const loadUser = async () => {
            try {
                const response = await fetchCurrentUser();
                setUser(response.data);
            } catch (error) {
                setUser(null); // No user or error fetching
                console.error("Failed to fetch current user", error.response?.data || error.message);
            } finally {
                setLoading(false);
            }
        };
        loadUser();
    }, []);

    const login = (userData) => { // Called after successful API login
        setUser(userData);
    };

    const logout = async () => {
        try {
            await apiLogout(); // Call API to invalidate session on backend
            setUser(null);
        } catch (error) {
            console.error("Logout failed", error.response?.data || error.message);
            // Still set user to null on client-side even if API logout fails
            setUser(null);
        }
    };

    return (
        <AuthContext.Provider value={{ user, setUser, login, logout, loading }}>
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => useContext(AuthContext);
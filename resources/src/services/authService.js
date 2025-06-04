// src/services/authService.js
import apiClient from '../api/axios';

export const registerUser = async (userData) => {
    // userData: { username, password, password_confirmation }
    return apiClient.post('/register', userData);
};

export const loginUser = async (credentials) => {
    // credentials: { username, password }
    return apiClient.post('/login', credentials);
};

export const logoutUser = async () => {
    return apiClient.post('/logout');
};

export const fetchCurrentUser = async () => {
    return apiClient.get('/me');
};
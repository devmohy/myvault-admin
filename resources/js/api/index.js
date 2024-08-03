import axios from 'axios';
import { useAuthStore } from '@/stores/auth';
import { useNotificationStore } from '@/stores/notification';
import router from '@/routes/index.js';

const api = axios.create({
  baseURL: '/api',
});

api.interceptors.request.use((config) => {
  const token = useAuthStore().token;
  config.headers.Accept = 'application/json';
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

api.interceptors.response.use(
  (response) => response,
  (error) => {
    const { response } = error;

    // Handle specific error codes or status codes
    if (response) {
      if (response.status === 401) {
        // Unauthorized, redirect to login or perform logout
        useAuthStore().logout();
        router.push('/login');
      } else if (response.status === 404) {
        // Handle Not Found error
        useNotificationStore().setError('Resource not found.');
      } else {
        // Handle other errors
        useNotificationStore().setError('An error occurred.');
      }
    } else {
      // Handle network errors or other unexpected issues
      useNotificationStore().setError('Network error. Please try again.');
    }

    return Promise.reject(error);
  }
);

export default api;

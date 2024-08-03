import { defineStore } from 'pinia';
import api from "@/api";

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || null,
  }),
  actions: {
    login({ user, token }) {
      this.user = user;
      this.token = token;
      localStorage.setItem('token', token);
      localStorage.setItem('user', JSON.stringify(user));
      console.log('login user:', user)
    },
    logout() {
      this.user = null;
      this.token = null;
      localStorage.removeItem('token');
      localStorage.removeItem('user');
    },

    async verifyEmail(query) {
      try {

    console.log(query)
        const response = await api.post('email/verify', query);
        return response.data;
      } catch (error) {
        console.error('Error verifying email:', error);
        throw error; // Re-throw the error to be handled in the component
      }
    },

    async getAuthUser() {
      try {
        const response = await api.get('user'); // Replace 'user' with your endpoint
        const user = response.data.data;
        console.log('auth user:', user)
        this.user = user;
        localStorage.setItem('user', JSON.stringify(user));
      } catch (error) {
        console.error('Error getting authenticated user:', error);
        this.logout(); // Log out the user if an error occurs
        throw error; // Re-throw the error to be handled in the component
      }
    }
  },
  getters:{
    isLoggedIn: (state) => state.user !== null,
    currentUserPermissions: (state) => state.user.permissions ?? [],
    userType: (state) => state.user.type,
    isEmailVerified: (state) => state.user.has_verified_email == null
  }
});

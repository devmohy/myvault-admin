// src/store/notification.js
import { defineStore } from 'pinia';

export const useNotificationStore = defineStore('notification', {
  state: () => ({
    error: null,
  }),
  actions: {
    setError(errorMessage) {
      this.error = errorMessage;
      // Optionally, use a notification library or show error messages in your UI
      // e.g., notify(errorMessage)
    },
    clearError() {
      this.error = null;
    },
  },
});

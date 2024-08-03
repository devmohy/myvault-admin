import { defineStore } from 'pinia';
import api from "@/api";

export const useRolesStore = defineStore('roles', {
  state: () => ({
    roles: [],
  }),
  actions: {
    async fetchRoles() {
      try {
        const response = await api.get('/roles');
        this.roles = response.data.data;
      } catch (error) {
        console.error('Fetch role failed:', error);
        // Handle error as needed
      }
    },
    async createRole(roleData) {
      try {
        const response = await api.post('/roles', roleData);
        this.roles.push(response.data.data);
        // Show success toast or handle success as needed
      } catch (error) {
        console.error('Create role failed:', error);
        // Show error toast or handle error as needed
      }
    },
  },
});

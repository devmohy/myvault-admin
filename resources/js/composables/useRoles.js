import { reactive, onMounted, toRefs } from 'vue';
import api from '@/api';
import { useToast } from 'vue-toastification';

export function useRoles() {
  const state = reactive({
    roles: [],
    role: {},
    isLoading: false,
    filters: {
      status: '',
      date_range: []
      
    },
    search: '', // Search string
    pagination: {
      current_page: 1,  // Set default current page to 1
      per_page: 10,
      total: 0,
      next_page_url: null,
      prev_page_url: null,
    }
  });

  const toast = useToast();

  async function fetchRoles(per_page = 10) {
    try {
      state.isLoading = true;
      const params = {
        filters: state.filters, // Pass the array of filters
        search: state.search,
        page: state.pagination.current_page,
        per_page: per_page
      };

      const response = await api.get('/roles', { params });
      state.roles = response.data.data;
      state.pagination = response.data.pagination
    } catch (error) {
      handleRequestError('Fetch roles', error);
    } finally {
      state.isLoading = false;
    }
  }

  function setPage(page) {
    // Update the current page
    state.pagination.current_page = page;
  }

  async function fetchRole(roleId) {
    try {
      const response = await api.get(`/roles/${roleId}`);
      state.role = response.data.data;
      return state.role;
    } catch (error) {
      handleRequestError('Fetch role', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function createRole(roleData) {
    try {
      state.isLoading = true;
      const response = await api.post('/roles', roleData);
      toast.success(response.data.message);
      await fetchRoles(); // Refresh the roles list after creating a new role
    } catch (error) {
      handleRequestError('Create role', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function updateRole(roleId, roleData) {
    try {
      state.isLoading = true;
      const response = await api.post(`/roles/${roleId}`, roleData);
      toast.success(response.data.message);
      await fetchRoles();
    } catch (error) {
      handleRequestError('Update role', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function updateStatus(roleId, roleData) {
    try {
      state.isLoading = true;
      const response = await api.post(`/roles/${roleId}/update-status`, roleData);
      toast.success(response.data.message);
      await fetchRoles();
    } catch (error) {
      handleRequestError('Update role', error);
    } finally {
      state.isLoading = false;
    }
  }

  function handleRequestError(action, error) {
    if (error.response) {
      if (error.response.status === 422 && error.response.data.errors) {
        // Assuming Laravel's validation errors are returned in error.response.data.errors
        const validationErrors = error.response.data.errors;
        const errorMessage = Object.values(validationErrors).flat().join('\n');
        toast.error(errorMessage);
      } else if (error.response.data.message) {
        // Show error.response.data.message if available
        toast.error(error.response.data.message);
      } else {
        // For other types of errors
        console.error(`${action} failed:`, error);
        toast.error(`Failed to ${action.toLowerCase()}. Please try again.`);
      }
    } else {
      // For network errors or other unexpected errors
      console.error(`${action} failed:`, error);
      toast.error(`Failed to ${action.toLowerCase()}. Please try again.`);
    }
  }

  return {
    ...toRefs(state),
    createRole,
    fetchRoles,
    fetchRole,
    updateRole,
    updateStatus,
    setPage
  };
}

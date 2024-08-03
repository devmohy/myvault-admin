import { reactive, onMounted, toRefs } from 'vue';
import api from '@/api';
import { useToast } from 'vue-toastification';

export function useTeamMembers() {
  const state = reactive({
    teamMembers: [],
    teamMember: {},
    isLoading: false,
    filters: {
      status: '',
      role_id: '',
      date_range: [],
    }, // Array of filters
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

  async function fetchTeamMembers() {
    try {
      state.isLoading = true;
      const params = {
        filters: state.filters, // Pass the array of filters
        search: state.search,
        page: state.pagination.current_page,
      };

      const response = await api.get('/team-members', { params });
      state.teamMembers = response.data.data;
      state.pagination = response.data.pagination
    } catch (error) {
      handleRequestError('Fetch team members', error);
    } finally {
      state.isLoading = false;
    }
  }

  function setPage(page) {
    // Update the current page
    state.pagination.current_page = page;
  }

  async function fetchTeamMember(id) {
    try {
      const response = await api.get(`/team-members/${id}`);
      state.teamMember = response.data.data;
      return state.role;
    } catch (error) {
      handleRequestError('Fetch team member', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function createTeamMember(data) {
    try {
      state.isLoading = true;
      const response = await api.post('/team-members', data);
      toast.success(response.data.message);
      await fetchTeamMembers(); // Refresh the roles list after creating a new role
    } catch (error) {
      console.log(error);
      toast.error(error.response.data.message);
    } finally {
      state.isLoading = false;
    }
  }

  async function reinviteTeamMember(data) {
    try {
      state.isLoading = true;
      const response = await api.post('/team-members/resend', data);
      toast.success(response.data.message);
      await fetchTeamMembers(); // Refresh the roles list after creating a new role
    } catch (error) {
      console.log(error);
      toast.error(error.response.data.message);
    } finally {
      state.isLoading = false;
    }
  }

  async function updateTeamMember(id, data) {
    try {
      state.isLoading = true;
      const response = await api.post(`/team-members/${id}`, data);
      toast.success(response.data.message);
      await fetchTeamMembers();
    } catch (error) {
      handleRequestError('Update team member', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function updateStatus(roleId, roleData) {
    try {
      state.isLoading = true;
      const response = await api.post(`/team-members/${roleId}/update-status`, roleData);
      toast.success(response.data.message);
      await fetchTeamMembers();
    } catch (error) {
      handleRequestError('Update team member status', error);
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
    createTeamMember,
    fetchTeamMembers,
    fetchTeamMember,
    updateTeamMember,
    updateStatus,
    reinviteTeamMember,
    setPage
  };
}

import { reactive, onMounted, toRefs } from 'vue';
import api from '@/api';
import { useToast } from 'vue-toastification';

export function useAuditTrail() {
  const state = reactive({
    audits: [],
    employee: {},
    isLoading: false,
    filters: {
      event_type: '',
      date_range: []
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

  async function fetchAuditTrail() {
    try {
      state.isLoading = true;
      const params = {
        filters: state.filters, // Pass the array of filters
        search: state.search,
        page: state.pagination.current_page,
      };

      const response = await api.get('/audit', { params });
      state.audits = response.data.data;
      state.pagination = response.data.pagination
    } catch (error) {
      handleRequestError('Fetch employees', error);
    } finally {
      state.isLoading = false;
    }
  }

  function setPage(page) {
    // Update the current page
    state.pagination.current_page = page;
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
    fetchAuditTrail,
    setPage
  };
}

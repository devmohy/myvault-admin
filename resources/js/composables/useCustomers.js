import { reactive, onMounted, toRefs } from 'vue';
import api from '@/api';
import { useToast } from 'vue-toastification';

export function useCustomers() {
  const state = reactive({
    customers: [],
    stats: [],
    customer: {},
    payrollItems: {},
    isLoading: false,
    filters: {
      status: 'all',
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

  async function fetchLoanStat() {
    try {
      state.isLoading = true;
      const response = await api.get("/loans/stat");
      state.stats = response.data.summaries;
    } catch (error) {
      handleRequestError('Fetch payroll summary', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function fetchCustomers() {
    try {
      state.isLoading = true;
      const params = {
        filters: state.filters, // Pass the array of filters
        search: state.search,
        page: state.pagination.current_page,
      };

      const response = await api.get('/customers', { params });
      state.customers = response.data.data;
      state.pagination = response.data.pagination
    } catch (error) {
      handleRequestError('Fetch payrolls', error);
    } finally {
      state.isLoading = false;
    }
  }

  function setPage(page) {
    // Update the current page
    state.pagination.current_page = page;
  }

  async function fetchCustomer(id) {
    try {
      state.isLoading = true;
      const response = await api.get(`/customers/${id}`);
      state.customer = response.data.data;
      return state.loan;
    } catch (error) {
      handleRequestError('Fetch loan', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function approveLoan(id) {
    try {
      state.isLoading = true;
      const response = await api.put(`/customers/${id}/approve`);
      toast.success(response.data.message);
      await fetchLoan(id);
    } catch (error) {
      handleRequestError('Error approving loan', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function declineLoan(id, reason) {
    try {
      state.isLoading = true;
      const response = await api.put(`/customers/${id}/decline`, {reason: reason});
      toast.success(response.data.message);
      await fetchLoan(id);
    } catch (error) {
      handleRequestError('Error declining loan', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function createLoan(data) {
    try {
      state.isLoading = true;
      const response = await api.post('/customers', data);
      toast.success(response.data.message);
      await fetchLoans();
    } catch (error) {
      console.log(error);
      toast.error(error.response.data.message);
    } finally {
      state.isLoading = false;
    }
  }


  async function updateEmployee(id, data) {
    try {
      state.isLoading = true;
      const response = await api.post(`/employee/${id}`, data);
      toast.success(response.data.message);
      await fetchTeamMembers();
    } catch (error) {
      handleRequestError('Update employee', error);
    } finally {
      state.isLoading = false;
    }
  }

  async function updateStatus(roleId, roleData) {
    try {
      state.isLoading = true;
      const response = await api.post(`/employee/${roleId}/update-status`, roleData);
      toast.success(response.data.message);
      await fetchTeamMembers();
    } catch (error) {
      handleRequestError('Update employee status', error);
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
    createLoan,
    fetchCustomers,
    fetchCustomer,
    approveLoan,
    declineLoan,
    updateEmployee,
    fetchLoanStat,
    updateStatus,
    setPage
  };
}

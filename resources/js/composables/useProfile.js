import { reactive, onMounted, toRefs } from 'vue';
import api from '@/api';
import { useToast } from 'vue-toastification';
import { useAuthStore } from "@/stores/auth";
export function useProfile() {
  const state = reactive({
    loan: {},
  });

  const toast = useToast();

  async function changePassword(data) {
    try {
      state.isLoading = true;
      const response = await api.post('/profile/change-password', data);
      toast.success(response.data.message);
      useAuthStore().logout();
    } catch (error) {
      console.log(error);
      toast.error(error.response.data.message);
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
    changePassword
  };
}

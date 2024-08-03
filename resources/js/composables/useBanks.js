import { reactive, onMounted, toRefs } from 'vue';
import api from '@/api';
import { useToast } from 'vue-toastification';
import { useAuthStore } from "@/stores/auth";
export function useBanks() {
  const state = reactive({
    banks: [],
    bank: {},
  });

  const toast = useToast();

  async function fetchBanks(data) {
    try {
      await api.get("/banks").then((response) => {
       state.banks = response.data.data;
      });
    } catch (error) {
      console.log("error getting list of banks", error);
      if (error.response.message) {
        toast.error(error);
        return;
      }
      toast.error("Error getting list of banks");
      return;
    }
  }

  async function fetchBank(id) {
    try {
      await api.get(`/banks/${id}`).then((response) => {
       state.bank = response.data.data;
      });
    } catch (error) {
      console.log("error getting list of banks", error);
      if (error.response.message) {
        toast.error(error);
        return;
      }
      toast.error("Error getting list of banks");
      return;
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
    fetchBanks,
    fetchBank
  };
}

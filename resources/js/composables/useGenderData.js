import { ref } from 'vue';
import api from '@/api';

export function useGenderData() {
  const genderData = ref({
    labels: [],
    data: []
  });
  const genderLoading = ref(false);

  const getGenderData = async () => {
    genderLoading.value = true;

    try {
      const response = await api.get("dashboard/stats/gender");
      genderData.value = {
        labels: response.data.labels,
        data: response.data.data
      };
    } catch (error) {
      console.error('Error fetching gender data:', error);
      // Optionally handle error with a toast or alert
      // toast.error('Failed to fetch gender data: ' + (error.response?.data?.message || 'Unknown error'));
    } finally {
      genderLoading.value = false;
    }
  };

  return {
    genderData,
    genderLoading,
    getGenderData
  };
}
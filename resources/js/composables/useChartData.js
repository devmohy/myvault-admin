import { ref } from 'vue';
import api from '@/api';

export function useChartData(apiEndpoint, defaultLabels = [], defaultData = []) {
  const data = ref({
    labels: defaultLabels,
    data: defaultData
  });
  const loading = ref(false);

  const fetchData = async () => {
    loading.value = true;

    try {
      const response = await api.get(apiEndpoint);
      data.value = {
        labels: response.data.labels || defaultLabels,
        data: response.data.data || defaultData
      };
    } catch (error) {
      console.error('Error fetching chart data:', error);
    } finally {
      loading.value = false;
    }
  };

  return {
    data,
    loading,
    fetchData
  };
}

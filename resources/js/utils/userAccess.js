import { useRoute, useRouter } from 'vue-router';
import { computed } from 'vue';

export const useUserAccess = () => {
  const router = useRouter();
  const route = useRoute();

  const isAdmin = computed(() => {
    return route.path.startsWith('/admin');
  });

  return {
    isAdmin,
  };
};
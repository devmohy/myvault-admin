import { useAuthStore } from "@/stores/auth";

export const can = (permission) => {
  const authStore = useAuthStore();
  const currentUserPermissions = authStore.currentUserPermissions;
  return currentUserPermissions.includes(permission);
};
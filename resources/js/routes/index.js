import { createRouter, createWebHistory } from 'vue-router';
import adminRoutes from '@/routes/adminRoutes';
import { useAuthStore } from '@/stores/auth';

const routes = [
  ...adminRoutes,
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  const isLoggedIn = authStore.isLoggedIn;
  const requiresAuth = to.meta.requiresAuth;
  const requiresUnauth = to.meta.requiresUnauth;
  const userType = authStore.user?.type;

  if(isLoggedIn) {
    authStore.getAuthUser();
  }

  if (requiresAuth && !isLoggedIn) {
    next('/login');
  } else if (requiresUnauth && isLoggedIn) {
    if (userType === 'admin') {
      next('/admin/dashboard');
    } else if (userType === 'business') {
      if (!authStore.user.has_verified_email && to.path !== '/register/email/verification') {
        next('/register/email/verification');
      } else {
        next();  // Allow navigation to proceed for other cases
      }
    } else {
      next();  // Allow navigation to proceed for other user types
    }
  } else {
    next();  // Allow navigation to proceed
  }
});






export default router;
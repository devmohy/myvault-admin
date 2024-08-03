import Login from '@/pages/auth/Login.vue';
import ForgotPassword from '@/pages/auth/ForgotPassword.vue';
import CheckResetPasswordMail from '@/pages/auth/CheckResetPasswordMail.vue';
import ResetPassword from '@/pages/auth/ResetPassword.vue';
import AcceptInvite from '@/pages/auth/AcceptInvite.vue';
import Dashboard from '@/pages/dashboard/Dashboard.vue';
import IndexSaivngs from '@/pages/savings/index.vue';
import CustomerDetalis from '@/pages/customers/show.vue';
import CustomerList from '@/pages/customers/index.vue';
import ListTeamMembers from '@/pages/team-members/ListTeamMembers.vue';
import TeamMemberDetails from '@/pages/team-members/TeamMemberDetails.vue';
import ViewAuditTrail from '@/pages/audit-trail/ViewAuditTrail.vue';
import IndexTransaction from '@/pages/transaction/index.vue';
import TransactionDetails from '@/pages/transaction/show.vue';
import IndexRole from '@/pages/role/index.vue';
import Settings from '@/pages/settings/ViewSettings.vue';
export default [
  {
    path: '/',
    alias: '/login',
    name: 'admin.login',
    component: Login,
    meta: { 
      requiresUnauth: true,
      isAdmin: true 
    },
  },
  {
    path: '/admin/invite/accept',
    name: 'admin.accept.invite',
    component: AcceptInvite,
    meta: { 
      requiresUnauth: true,
      isAdmin: true 
    },
  },
  {
    path: '/admin/password/forgot',
    name: 'admin.password.forgot',
    component: ForgotPassword,
    meta: { 
      requiresUnauth: true,
      isAdmin: true
    },
  },
  {
    path: '/admin/password/forgot/email',
    name: 'admin.password.forgot.email',
    component: CheckResetPasswordMail,
    meta: { 
      requiresUnauth: true 
    },
  },
  {
    path: '/admin/password/reset',
    name: 'admin.password.reset',
    component: ResetPassword,
    meta: { 
      requiresUnauth: true,
      isAdmin: true 
    },
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: { requiresAuth: true}
  },
  {
    path: '/transactions',
    name: 'transactions',
    component: IndexTransaction,
    meta: { requiresAuth: true}
  },
  {
    path: '/savings',
    name: 'savings',
    component: IndexSaivngs,
    meta: { requiresAuth: true}
  },
  {
    path: '/savings/:id',
    name: 'savings.details',
    props: true,
    component: IndexSaivngs,
    meta: { requiresAuth: true}
  },
  {
    path: '/customers',
    name: 'customers',
    component: CustomerList,
    meta: { requiresAuth: true}
  }, 
  {
    path: '/customers/:id',
    name: 'customers.details',
    props: true,
    component: CustomerDetalis,
    meta: { 
      requiresAuth: true,
      isAdmin: true
    }
  },
  {
    path: '/admins',
    name: 'admins',
    component: ListTeamMembers,
    meta: { 
      requiresAuth: true,
      isAdmin: true
    }
  },
  {
    path: '/admins/:id',
    name: 'admins.details',
    props: true,
    component: TeamMemberDetails,
    meta: { 
      requiresAuth: true,
      isAdmin: true
    }
  },


  {
    path: '/audit',
    name: 'audit',
    component: ViewAuditTrail,
    meta: { 
      requiresAuth: true,
      isAdmin: true
    }
  },
  {
    path: '/roles',
    name: '/roles',
    component: IndexRole,
    meta: { requiresAuth: true}
  },
  {
    path: '/settings',
    name: 'settings',
    component: Settings,
    meta: { requiresAuth: true}
  }
]
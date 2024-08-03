import Dashboard from './pages/dashboard/Dashboard.vue';
import CustomerList from './pages/customers/CustomerList.vue';
import CustomerSinglePage from './pages/customers/CustomerSinglePage.vue';
import TransactionList from './pages/transactions/TransactionList.vue';
import SavingsList from './pages/savings/SavingsList.vue';
import InvestmentList from './pages/investments/InvestmentList.vue';
import InvestmentMemberList from './pages/investmentmembers/InvestmentMemberList.vue';
import PropertyList from './pages/properties/PropertyList.vue';
import Login from './pages/auth/Login.vue';
import UserList from './pages/users/UserList.vue';
import DueSavingsList from './pages/savings-due/DueSavingsList.vue';
export default [
  {
    path: '/login',
    name: 'admin.login',
    component: Login
  },  
  {
    path: '/admin/dashboard',
    name: 'admin.dashboard',
    component: Dashboard
  },  
  {
    path: '/admin/customers',
    name: 'admin.customers',
    component: CustomerList
  },
  {
    path: '/admin/customer/:id',
    name: 'admin.customers.single',
    component: CustomerSinglePage
  },
  {
    path: '/admin/savings',
    name: 'admin.savings',
    component: SavingsList
  },
    {
    path: '/admin/savings/due',
    name: 'admin.savings.due',
    component: DueSavingsList
  },
  {
    path: '/admin/transactions',
    name: 'admin.transactions',
    component: TransactionList
  },
  {
    path: '/admin/investments',
    name: 'admin.investments',
    component: InvestmentList
  },
  {
    path: '/admin/investment/members',
    name: 'admin.investments.members',
    component: InvestmentMemberList
  },
  {
    path: '/admin/properties',
    name: 'admin.properties',
    component: PropertyList
  },  
  {
    path: '/admin/users',
    name: 'admin.users',
    component: UserList
  },
]
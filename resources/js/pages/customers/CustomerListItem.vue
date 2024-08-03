<script setup>
defineProps({
  user: Object,
  index: Number,
});
</script>
<template>
  <tr>
    <td>
      {{ index + 1 }}
    </td>
    <td>{{ new Date(user.created_at).toDateString() }}</td>
    <td>
      {{ user.name }}
    </td>
    <td class="budget">
      {{ user.email }}
    </td>
    <td>{{ user.phone_number }}</td>
    <td>{{ filters.formatMoney(user.savings_balance) }}</td>
    <td>{{ filters.formatMoney(user.wallet_balance) }}</td>
    <td>{{ filters.formatMoney(user.wallet_balance) }}</td>
    <td>
      <span
        class="badge badge-pil flex m-1"
        :class="user.is_active ? 'badge-success' : 'badge-danger'"
        >{{ user.is_active ? "active" : "not active" }}</span
      >
    </td>
    <td class="text-center">
      <!-- Todo 
        1. Statement of account
        2. Search functionality
        3. Select users by date range
        4. change user email (Admin ony)
        5. change user phone (Admin ony)
        5. Suspend / Unsuspend (Admin ony)
        -->
      <div class="dropdown">
        <a
          class="btn btn-sm btn-icon-only text-light"
          href="#"
          role="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
          <router-link class="dropdown-item" :to="`/admin/customer/${user.id}`" :user=user>View</router-link>
          <a class="dropdown-item" href="#">Suspend</a>
          <a class="dropdown-item" href="#"></a>
        </div>
      </div>
    </td>
  </tr>
</template>

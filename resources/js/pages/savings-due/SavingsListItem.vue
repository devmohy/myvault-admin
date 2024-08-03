<script setup>
defineProps({
  saving: Object,
  index: Number,
})
</script>
<template>
  <tr>
    <td>
      {{ index + 1 }}
    </td>
    <td>
      {{ new Date(saving.created_at).toLocaleString() }}
    </td>
    <td>
      {{ saving.title }}
    </td>
    <td>{{ saving.start_date }}</td>
    <td>{{ saving.end_date }}</td>
    <td>
      <router-link :to="`/admin/customer/${saving?.user.id}`">
        {{  saving.user.name }}
      </router-link>
    </td>
    <td>
      <router-link :to="`/admin/customer/${saving?.user.id}`">
        {{  saving.user.email }}
      </router-link>
    </td>
    <td>
      {{  saving.user.phone_number }}
    </td>
    <td>
      {{ saving.type }}
    </td>
    <td>{{ filters.formatMoney(saving.frequent_amount) }} {{ saving.frequency_type }}</td>
    <td>{{ filters.formatMoney(saving.balance.available_balance) }}</td>
    <td>{{ filters.formatMoney(saving.balance.available_balance) }}</td>
    <td>{{ saving.duration }}</td>
    <td>{{ saving?.primary_charge_source_type }}</td>
    <td>
      <span class="badge badge-pil flex m-1" :class="saving.active ? 'badge-success' : 'badge-danger'">{{ saving.active ? "active" : "not active" }}</span>
    </td>
    <td class="text-center">
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
          <a class="dropdown-item" href="#">View</a>
          <a class="dropdown-item" href="#">View Transactions</a>
        </div>
      </div>
    </td>
  </tr>
</template>
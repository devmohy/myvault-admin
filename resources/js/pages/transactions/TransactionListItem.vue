<script setup>
defineProps({
  transaction: Object,
  index: Number,
})
</script>
<template>
  <tr>
    <td>
      {{ index + 1 }}
    </td>
    <th scope="row">
      {{ new Date(transaction.created_at).toLocaleString() }}
    </th>
    <th scope="row">
      {{ transaction.reference }}
    </th>
    <th scope="row">
      {{ transaction.type }}
    </th>
    <th scope="row">
      {{ filters.formatMoney(transaction.amount) }}
    </th>
    <td class="budget">
      {{ transaction.user.name }} - {{ transaction.user.phone_number }}
    </td>
    <td>{{ transaction.narration }}</td>
    <td>
      <span class="badge badge-pil flex m-1" :class="transaction.transaction_status ? 'badge-success' : 'badge-danger'">{{ transaction.transaction_status ? transaction.transaction_status : "not active" }}</span>
    </td>
    <td class="text-center">
        <a
          class="btn btn-primary btn-sm m-1"
          data-toggle="tooltip"
          data-placement="top"
          title="View customer"
          href="#"
        >
          <i class="fa fa-eye" aria-hidden="true"></i>
        </a>
    </td>
  </tr>
</template>
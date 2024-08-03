<script setup>
defineProps({
  investment: Object,
  index: Number,
})
</script>
<template>
  <tr>
    <td>
      {{ index + 1 }}
    </td>
    <td>{{ new Date(investment.created_at).toLocaleString() }}</td>
    <th scope="row">
      {{ investment.property.name }}
    </th>
    <td class="budget">
      {{ investment.property.location }}
    </td>
    <td>
      <router-link :to="`/admin/customer/${investment?.user?.id}`">
        {{ investment?.user?.name }} - {{ investment.user?.phone_number }}
      </router-link>
    </td>
    <td>{{ investment.slots }}</td>
    <td>{{ investment.slots * investment.property.slot_price }}</td>
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
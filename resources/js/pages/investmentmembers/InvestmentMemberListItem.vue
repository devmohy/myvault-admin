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
      {{ investment.user.name }}
    </th>
    <td class="budget">
      {{ investment.user.email }}
    </td>
    <td>{{ investment.user.phone_number }}</td>
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
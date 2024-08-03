<script setup>
defineProps({
  property: Object,
  index: Number,
})
</script>
<template>
  <tr>
    <td>
      {{ index + 1 }}
    </td>
    <td>{{new Date(property.created_at).toDateString() }}</td>
    <th scope="row">
      {{ property.name }}
    </th>
    <td class="budget">
      {{ property.location }}
    </td>
    <td>{{ property.total_slots }}</td>
    <td>{{ property.slot_price }}</td>
    <td>{{ property.member_slot_price }}</td>
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
          <a class="dropdown-item" href="#" @click.prevent="$emit('editUser', user)"
            ><i class="fa fa-edit"></i>Update User</a
          >
          <a class="dropdown-item" href="#" @click.prevent="$emit('confirmUserDeletion', user.id)"
            ><i class="fa fa-trash text-danger"></i
          >Delete User</a>
        </div>
      </div>
    </td>
  </tr>
</template>
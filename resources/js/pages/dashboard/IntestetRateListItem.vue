<script setup>
defineProps({
  intestRate: Object,
  index: Number,
})
</script>
<template>
  <tr>
    <td>
      {{ index + 1 }}
    </td>
    <td>{{ intestRate?.tenure }} {{ intestRate?.type }}S </td>
    <td>
      {{ intestRate?.interest_rate }}%
    </td>
    <td>
      {{ intestRate?.product }}
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
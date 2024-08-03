<script setup>
import { formatDate } from "../../helper.js";
import { ref } from "vue";
import { useToastr } from "../../toastr.js";
import axios from "axios";

const toastr = useToastr();

const props = defineProps({
  user: Object,
  index: Number,
  selectAll: Boolean,
});

const emit = defineEmits(["userDeleted", "editUser", "confirmUserDeletion"]);

const roles = ref([
  {
    name: "SUPERADMIN",
    value: 1,
  },
  {
    name: "ADMIN",
    value: 2,
  },
]);

const changeRole = (user, role) => {
  axios
    .patch(`/api/users/${user.id}/change-role`, {
      role: role,
    })
    .then(() => {
      toastr.success("Role changed successfully!");
    });
};

const toggleSelection = () => {
  emit("toggleSelection", props.user);
};
</script>
<template>
  <tr>
    <td><input type="checkbox" :checked="selectAll" @change="toggleSelection" /></td>
    <td>{{ index + 1 }}</td>
    <td>{{ user.name }}</td>
    <td>{{ user.email }}</td>
    <td>{{ formatDate(user.created_at) }}</td>
    <td>
        ADMIN
      <!-- <select class="form-control" @change="changeRole(user, $event.target.value)">
        <option
          v-for="role in roles"
          :value="role.value"
          :selected="user.role === role.name"
        >
          {{ role.name }}
        </option>
      </select> -->
    </td>
    <td>
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

<script setup>
import axios from "axios";
import { ref, onMounted, reactive, watch } from "vue";
import { Form, Field, useResetForm } from "vee-validate";
import * as yup from "yup";
import { useToastr } from "../../toastr.js";
import UserListItem from "./UserListItem.vue";
import { debounce } from "lodash";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

const toastr = useToastr();
const users = ref({ data: [] });
const editing = ref(false);
const formValues = ref();
const form = ref(null);

const getUsers = (page = 1) => {
  axios
    .get(`/api/users?page=${page}`, {
      params: {
        query: searchQuery.value,
      },
    })
    .then((response) => {
      users.value = response.data;
      selectedUsers.value = [];
      selectAll.value = false;
    });
};

const createUserSchema = yup.object({
  first_name: yup.string().required(),
  last_name: yup.string().required(),
  phone_number: yup.string().required(),
  email: yup.string().email().required(),
});

const editUserSchema = yup.object({
  first_name: yup.string().required(),
  last_name: yup.string().required(),
  phone_number: yup.string().required(),
  email: yup.string().email().required(),
  password: yup.string().when((password, schema) => {
    return password ? schema.required().min(8) : schema;
  }),
});

const createUser = (values, { resetForm, setErrors }) => {
  axios
    .post("/api/users", values)
    .then((response) => {
      users.value.data.unshift(response.data);
      $("#userFormModal").modal("hide");
      resetForm();
      toastr.success("User created successfully!");
    })
    .catch((error) => {
      if (error.response.data.errors) {
        setErrors(error.response.data.errors);
      }
    });
};

const addUser = () => {
  editing.value = false;
  $("#userFormModal").modal("show");
};

const editUser = (user) => {
  editing.value = true;
  form.value.resetForm();
  $("#userFormModal").modal("show");
  formValues.value = {
    id: user.id,
    first_name: user.first_name,
    last_name: user.last_name,
    phone_number: user.phone_number,
    email: user.email,
  };
};

const updateUser = (values, { setErrors }) => {
  axios
    .put("/api/users/" + formValues.value.id, values)
    .then((response) => {
      const index = users.value.data.findIndex((user) => user.id === response.data.id);
      users.value.data[index] = response.data;
      $("#userFormModal").modal("hide");
      toastr.success("User updated successfully!");
    })
    .catch((error) => {
      setErrors(error.response.data.errors);
      console.log(error);
    });
};

const handleSubmit = (values, actions) => {
  // console.log(actions);
  if (editing.value) {
    updateUser(values, actions);
  } else {
    createUser(values, actions);
  }
};

const searchQuery = ref(null);

const selectedUsers = ref([]);
const toggleSelection = (user) => {
  const index = selectedUsers.value.indexOf(user.id);
  if (index === -1) {
    selectedUsers.value.push(user.id);
  } else {
    selectedUsers.value.splice(index, 1);
  }
  console.log(selectedUsers.value);
};

const userIdBeingDeleted = ref(null);
const confirmUserDeletion = (id) => {
  userIdBeingDeleted.value = id;
  $("#deleteUserModal").modal("show");
};

const deleteUser = () => {
  axios.delete(`/api/users/${userIdBeingDeleted.value}`).then(() => {
    $("#deleteUserModal").modal("hide");
    toastr.success("User deleted successfully!");
    users.value.data = users.value.data.filter(
      (user) => user.id !== userIdBeingDeleted.value
    );
  });
};

const bulkDelete = () => {
  axios
    .delete("/api/users", {
      data: {
        ids: selectedUsers.value,
      },
    })
    .then((response) => {
      users.value.data = users.value.data.filter(
        (user) => !selectedUsers.value.includes(user.id)
      );
      selectedUsers.value = [];
      selectAll.value = false;
      toastr.success(response.data.message);
    });
};

const selectAll = ref(false);
const selectAllUsers = () => {
  if (selectAll.value) {
    selectedUsers.value = users.value.data.map((user) => user.id);
  } else {
    selectedUsers.value = [];
  }
  console.log(selectedUsers.value);
};

watch(
  searchQuery,
  debounce(() => {
    getUsers();
  }, 300)
);

onMounted(() => {
  getUsers();
});
</script>

<template>
  <div>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white ml-2 p-0 mb-0">Users</h6>
            </div>
            <div class="col-lg-6 col-5 text-right"></div>
            <div class="col-lg-12 col-12"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="content">
              <div class="container-fluid">
                <div class="d-flex justify-content-between p-2">
                  <div class="d-flex">
                    <button @click="addUser" type="button" class="mb-2 btn btn-primary">
                      <i class="fa fa-plus-circle mr-1"></i>
                      Add New User
                    </button>
                    <div v-if="selectedUsers.length > 0">
                      <button
                        @click="bulkDelete"
                        type="button"
                        class="ml-2 mb-2 btn btn-danger"
                      >
                        <i class="fa fa-trash mr-1"></i>
                        Delete Selected
                      </button>
                      <span class="ml-2">Selected {{ selectedUsers.length }} users</span>
                    </div>
                  </div>
                  <div>
                    <input
                      type="text"
                      v-model="searchQuery"
                      class="form-control"
                      placeholder="Search..."
                    />
                  </div>
                </div>
                <table class="table table-hover align-items-center">
                  <thead>
                    <tr>
                      <th>
                        <input
                          type="checkbox"
                          v-model="selectAll"
                          @change="selectAllUsers"
                        />
                      </th>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Registered Date</th>
                      <th>Role</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody v-if="users.data.length > 0">
                    <UserListItem
                      v-for="(user, index) in users.data"
                      :key="user.id"
                      :user="user"
                      :index="index"
                      @edit-user="editUser"
                      @confirm-user-deletion="confirmUserDeletion"
                      @toggle-selection="toggleSelection"
                      :select-all="selectAll"
                    />
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="6" class="text-center">No results found...</td>
                    </tr>
                  </tbody>
                </table>
                <Bootstrap4Pagination :data="users" @pagination-change-page="getUsers" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="userFormModal"
    data-backdrop="static"
    tabindex="-1"
    role="dialog"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <span v-if="editing">Edit User</span>
            <span v-else>Add New User</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <Form
          ref="form"
          @submit="handleSubmit"
          :validation-schema="editing ? editUserSchema : createUserSchema"
          v-slot="{ errors }"
          :initial-values="formValues"
        >
          <div class="modal-body">
            <div class="form-group">
              <label for="name">First Name</label>
              <Field
                name="first_name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.first_name }"
                id="first_name"
                aria-describedby="nameHelp"
                placeholder="Enter full name"
              />
              <span class="invalid-feedback">{{ errors.first_name }}</span>
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <Field
                name="last_name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.last_name }"
                id="last_name"
                aria-describedby="nameHelp"
                placeholder="Enter full name"
              />
              <span class="invalid-feedback">{{ errors.last_name }}</span>
            </div>
            <div class="form-group">
              <label for="phone_number">Phone Number</label>
              <Field
                name="phone_number"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.phone_number }"
                id="phone_number"
                aria-describedby="nameHelp"
                placeholder="Enter full name"
              />
              <span class="invalid-feedback">{{ errors.phone_number }}</span>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <Field
                name="email"
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                id="email"
                aria-describedby="nameHelp"
                placeholder="Enter full name"
              />
              <span class="invalid-feedback">{{ errors.email }}</span>
            </div>

            <div class="form-group">
              <label for="email">Password</label>
              <Field
                name="password"
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                id="password"
                aria-describedby="nameHelp"
                placeholder="Enter password"
              />
              <span class="invalid-feedback">{{ errors.password }}</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </Form>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="deleteUserModal"
    data-backdrop="static"
    tabindex="-1"
    role="dialog"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <span>Delete User</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Are you sure you want to delete this user ?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
          </button>
          <button @click.prevent="deleteUser" type="button" class="btn btn-primary">
            Delete User
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

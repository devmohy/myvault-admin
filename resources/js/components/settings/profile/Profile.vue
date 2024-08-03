<script setup>
import PasswordField from "@/components/PasswordField.vue";
import DisabledInputField from "@/components/DisabledInputField.vue";
import { ref, reactive } from "vue";
import { useAuthStore } from "@/stores/auth";
const user = useAuthStore().user;

import { useProfile } from "@/composables/useProfile";
const { changePassword } = useProfile();
const form = reactive({
  new_password_confirmation: "",
  new_password: "",
  current_password: "",
});
const handleUpdateProfile = async () => {
  await changePassword(form);
  form.current_password = "";
  (form.new_password_confirmation = ""), (form.new_password = "");
  setTimeout(() => {
    window.location.reload();
  }, 2000);
};
</script>
<template>
  <div class="border border-[#EAECF0] mb-4 p-4 rounded-lg bg-[#FFFFFF] dark:bg-[#FFFFFF]">
    <div class="w-4/5">
      <p class="text text-base font-semibold text-[#101828]">Profile</p>
      <div class="grid gap-x-4 md:grid-cols-2 mt-8">
        <DisabledInputField
          id="first_name"
          label="First name"
          :value="user.first_name"
          type="text"
        />
        <DisabledInputField
          id="last_name"
          label="Last name"
          :value="user.last_name"
          type="text"
        />
        <DisabledInputField
          id="email_address"
          label="Email address"
          :value="user.email"
          type="text"
        />

        <div class="col-span-1">
          <label
            for="phone"
            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
            >Phone number</label
          >

          <vue-tel-input
            v-model="user.phone_number"
            mode="international"
            inputOptions.maxlength="16"
          ></vue-tel-input>
        </div>
        <div class="col-span-1">
          <label
            for="roles"
            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
            >Role</label
          >
          <select
            id="roles"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            disabled
          >
            <option selected value="owner">{{ user.role.name }}</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import PasswordField from "@/components/PasswordField.vue";
import { ref, reactive } from "vue";

const isLoading = ref(false);
import { useProfile } from "@/composables/useProfile";
const { changePassword } = useProfile();
const form = reactive({
  new_password_confirmation: "",
  new_password: "",
  current_password: "",
});
const handleChangePassword = async () => {
  isLoading.value = true;
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
    <form @submit.prevent="handleChangePassword">
      <div class="w-full">
        <div class="w-4/5">
          <p class="text text-base font-semibold text-[#101828]">Change password</p>
          <div class="grid gap-x-4 md:grid-cols-2 mt-8">
            <div class="relative">
              <PasswordField
                v-model="form.current_password"
                label="Current password"
                id="current_password"
                maxlength="200"
              />
            </div>
            <div class="relative">
              <PasswordField
                v-model="form.new_password"
                label="New password"
                id="new_password"
                maxlength="200"
              />
            </div>
            <div class="relative">
              <PasswordField
                v-model="form.new_password_confirmation"
                label="Confirm new password"
                id="new_password_confirmation"
                maxlength="200"
              />
            </div>
          </div>
        </div>
        <div class="flex item-center justify-end">
          <button
            :disabled="isLoading"
            type="submit"
            class="text-[#FFFFFF] bg-[#00ace2] hover:bg-[#00ace2] focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-[#F2F4F7] dark:hover:bg-[#F2F4F7] focus:outline-none dark:focus:ring-[#F2F4F7] block"
          >
            {{ isLoading ? "Changing password" : "Change password" }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

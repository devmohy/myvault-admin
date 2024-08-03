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
    <div
      class="border border-[#EAECF0] mb-4 p-4 rounded-lg bg-[#FFFFFF] dark:bg-[#FFFFFF]"
    >
      <div class="w-full">
        <div class="w-4/5">
          <p class="text text-base font-semibold text-[#101828]">
            Two-step login verification
          </p>
          <p class="text text-sm text-[#475467] font-normal mt-4">
            Enabling two-factor authentication adds another layer of security to your
            account when you sign in.
          </p>
        </div>
        <div class="flex item-center justify-end">
          <button
            type="submit"
            class="text-[#FFFFFF] bg-[#00ace2] hover:bg-[#00ace2] focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-[#F2F4F7] dark:hover:bg-[#F2F4F7] focus:outline-none dark:focus:ring-[#F2F4F7] block"
          >
            Enable 2FA
          </button>
        </div>
      </div>
    </div>
</template>

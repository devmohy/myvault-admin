<script setup>
import PasswordField from "@/components/PasswordField.vue";
import { useRoute } from "vue-router";
const route = useRoute();
import { computed, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
const toast = useToast();
const router = useRouter();
import api from "@/api";
const form = reactive({
  password: "",
  password_confirmation: "",
});
const isLoading = ref(false);
const isFormInvalid = computed(() => {
  return (
    form.password === "" ||
    form.password_confirmation === "" ||
    form.password != form.password_confirmation
  );
});

const handleResetPassword = async () => {
  try {
    isLoading.value = true;
    const response = await api.post("/password/reset", {
      token: route.query.token,
      password: form.password,
      password_confirmation: form.password_confirmation,
    });
    toast.success(response.data.message);
    router.push({
      name: "login",
    });
  } catch (error) {
    console.error(error);
    toast.error("Invalid password reset token");
  } finally {
    isLoading.value = false;
  }
};
</script>
<template>
  <div class="max-w-[1940px] mx-auto max-h-[1113px] overflow-x-hidden">
    <div class="bg-white m-0 p-0 w-full flex">
      <div
        class="w-full bg-white xl:w-6/12 relative h-screen flex flex-col gap-3 items-center overflow-y-scroll no-scrollbar"
      >
        <div class="w-full bg-white border-b-10 border border-b-2 py-3 lg:px-10">
          <ul class="m-0 p-4 lg:p-0 flex items-center justify-between">
            <li class="hidden lg:block">
              <img alt="MyVault logo" src="@assets/logo.png" />
            </li>
            <li class="block lg:hidden">
              <img alt="MyVault logo" src="@assets/logo-mobile.png" />
            </li>
            <li class="hidden lg:block">
              Don’t have an account?
              <router-link to="/register">Create account</router-link>
            </li>
            <li class="block lg:hidden">
              <a href="#" class="btn-o btn-o-primary">Create account</a>
            </li>
          </ul>
        </div>
        <div class="w-11/12 mx-auto min-h-[90vh] flex flex-col justify-center">
          <div class="w-full lg:w-8/12 mx-auto mt-10">
            <div class="flex flex-col mb-6 gap-y-2">
              <h1 class="m-0 p-0 mb-2 text-3xl lg:text-5xl font-medium">
                Reset password
              </h1>
              <p>Enter your new password for your account {{ route.query.email }}.</p>
            </div>
            <form @submit.prevent="handleResetPassword">
              <PasswordField
                v-model="form.password"
                name="password"
                id="password"
                label="New password"
                :validationRules="{
                  minLength: true,
                  uppercase: true,
                  lowercase: true,
                  specialCharacter: true,
                }"
              />
              <div class="mb-4">
                <label
                  for="password"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Confirm new password</label
                >
                <input
                  v-model="form.password_confirmation"
                  type="password"
                  id="password_confirmation"
                  name="password_confirmation"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="•••••••••"
                  required
                />
              </div>

              <button
                type="submit"
                :disabled="isFormInvalid || isLoading"
                class="btn btn-primary"
              >
                Reset password
              </button>
            </form>
          </div>
        </div>
      </div>
      <div
        class="w-6/12 bg-[#1F3946] overflow-y-hidden relative hidden xl:block min-h-screen transition-all"
      >
      </div>
    </div>
  </div>
</template>

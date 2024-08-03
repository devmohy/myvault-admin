<script setup>
import InputField from "@/components/InputField.vue";
import {computed, reactive, ref} from 'vue'
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
const toast = useToast();
const router = useRouter();
import api from "@/api";
const form = reactive({
  email: ""
});
const isLoading = ref(false);
const isFormInvalid = computed(() => {
  const emailRegex =/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return (
    form.email === "" ||
    !emailRegex.test(form.email)
  );
});

const handleForgotPassword = async () => {
  try {
    isLoading.value = true;
    const response = await api.post("/password/forgot", {
      email: form.email
    });
    toast.success(response.data.message);
    router.push({
      name: "password.forgot.email",
      query: { email: form.email },
    });
  } catch (error) {
    console.error(error);
    toast.error("Invalid credentials");
  } finally {
    isLoading.value = false;
  }
}

</script>
<template>
  <div class="max-w-[1940px] mx-auto max-h-[1113px] overflow-x-hidden">
    <div class="bg-white m-0 p-0 w-full flex">
      <div
        class="w-full bg-white xl:w-6/12 relative h-screen flex flex-col gap-3 items-center overflow-y-scroll no-scrollbar"
      >
        <div
          class="w-full bg-white border-b-10 border border-b-2 py-3 lg:px-10"
        >
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
            <div class="flex flex-col mb-8 gap-y-2 text-[#101828]">
              <h1 class="m-0 p-0 mb-1 text-3xl lg:text-3xl font-semibold">
                Forgot password?
              </h1>
              <p class="text-[#475467] text-sm">
                Don’t worry, we’ve got you. Enter your registered email address, and we'll send you a link to reset your password.
              </p>
            </div>

            <form @submit.prevent="handleForgotPassword">
              <InputField
                id="email"
                label="Email address"
                type="email"
                placeholder="Enter your registered email address"
                v-model="form.email"
                maxLength="50"
              />
              <button type="submit" :disabled="isFormInvalid||isLoading" class="btn btn-primary">
                {{ isLoading ? "Sending link..." : "Send link" }}
              </button>
            </form>
          </div>
        </div>
      </div>
      <div
        class="w-6/12 bg-[#1F3946] relative overflow-y-hidden hidden xl:block min-h-screen transition-all"
      >
      </div>
    </div>
  </div>
</template>
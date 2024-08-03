<script setup>
import { useRouter, useRoute } from "vue-router";
import { useToast } from "vue-toastification";
const toast = useToast();
import {ref} from 'vue'
import api from "@/api";
const router = useRouter();
const route = useRoute();
const isLoading = ref(false);

const handleResend = async () => {
  try {
    isLoading.value = true;
    const response = await api.post("/password/forgot", {
      email: route.query.email
    });
    toast.success(response.data.message);
    router.push({
      name: "password.forgot.email",
      query: { email: route.query.email },
    });
  } catch (error) {
    console.error(error);
    toast.error("Invalid email");
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
        <div class="w-full bg-white border-b-10 border border-b-2 py-3 lg:px-10">
          <ul class="m-0 p-4 lg:p-0 flex items-center justify-between">
            <li class="hidden lg:block">
              <img alt="MyVault logo" src="@assets/logo.png" />
            </li>
            <li class="block lg:hidden">
              <img alt="MyVault logo" src="@assets/logo-mobile.png" />
            </li>
            <li class="hidden lg:block">
              Already have an account? <router-link to="/login">Log in</router-link>
            </li>
            <li class="block lg:hidden">
              <a href="#" class="btn-o btn-o-primary">Create account</a>
            </li>
          </ul>
        </div>
        <div class="w-11/12 mx-auto flex min-h-[90vh] flex-col justify-center items-center">
          <div class="w-full lg:w-8/12 mx-auto mt-20">
            <div class="flex flex-col mb-6 gap-y-2">
              <div class="flex flex-col mb-6 gap-y-4">
                <div class="mb-2">
                  <!-- <img alt="Check your inbox" src="@assets/icons/email-inbox.png" /> -->
                </div>
                <h1 class="m-0 p-0 mb-2 text-3xl lg:text-3xl font-semibold">
                  Check your inbox
                </h1>
                <p class="text-[#475467] text-sm">
                  An email has been sent to <strong>{{ route.query.email }}</strong> with a link to reset your password. If you do not see it, please check your spam folder.
                </p>
                <button type="submit" class="btn btn-primary">Open email</button>
                <div class="py-1 my-1 font-yaraa text-sm">
                  Didn’t get the email?
                  <button :disabled="isLoading" @click.prevent="handleResend">{{ isLoading ? "Sending link..." : "Resend" }}</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="w-6/12 bg-[#1F3946] relative hidden xl:block min-h-screen overflow-y-hidden transition-all"
      >
      </div>
    </div>
  </div>
</template>

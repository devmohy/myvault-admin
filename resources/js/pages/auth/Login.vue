<script setup>
import InputField from "@/components/InputField.vue";
import PasswordField from "@/components/PasswordField.vue";
import { useUserAccess } from "@/utils/userAccess";
import { useToast } from "vue-toastification";
import { reactive, computed, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import api from "@/api";

const router = useRouter();
const { isAdmin } = useUserAccess();

const authStore = useAuthStore();
const toast = useToast();

const isLoading = ref(false);

const form = reactive({
  email: "",
  password: "",
});

const formErrors = reactive({
  email: null,
  password: null,
});

const isFormInvalid = computed(() => {
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  formErrors.email = null;
  formErrors.password = null;

  if (form.email === "") {
    formErrors.email = "Email is required";
  } else if (!emailRegex.test(form.email)) {
    formErrors.email = "Invalid email format";
  }

  if (form.password === "") {
    formErrors.password = "Password is required";
  }

  return formErrors.email !== null || formErrors.password !== null;
});

const handleLogin = async () => {
  try {
    isLoading.value = true;
    const response = await api.post("/login", {
      email: form.email,
      password: form.password,
    });

    await authStore.login(response.data);

    if (authStore.user && authStore.user.type) {    
        router.push("/dashboard");
    } else {
      toast.error("Invalid login credentials");
    }
  } catch (error) {
    if (error.response) {
      // Server returned an error response
      const { data } = error.response;
      if (data.message) {
        toast.error(data.message);
        return;
      }
    }
  } finally {
    isLoading.value = false;
  }
};

const headerStyle = {
  textAlign: "center",
  color: "#fff",
  height: "400px",
  paddingInline: 50,
  lineHeight: "64px",
  backgroundColor: "#00ace2",
};
const contentStyle = {
  minHeight: 120,
  lineHeight: "120px",
  color: "#fff",
  marginTop: "-150px"
};
const footerStyle = {
  textAlign: "center"
};
</script>
<template>
    <a-space direction="vertical" :style="{ width: '100%' }" :size="[0, 48]">
      <a-layout>
        <a-layout-header :style="headerStyle" class="flex justify-center items-center">
          <div>
            <img alt="MyVault logo" src="@assets/logo-white.png" width="150" />
          </div>
        </a-layout-header>
        <a-layout-content :style="contentStyle">
          <div class="w-full lg:w-1/3 mx-auto my-10 bg-[#FFFFFF] p-5 border-solid rounded-lg shadow-md">
              <div class="flex flex-col mb-8 gap-y-2 text-[#101828]">
                <h1 class="m-0 p-0 mb-1 text-3xl lg:text-3xl font-semibold">Welcome back!</h1>
              </div>
              <form @submit.prevent="handleLogin">
                <InputField
                  v-model="form.email"
                  id="email"
                  label="Email address"
                  type="email"
                  placeholder="Enter your email address"
                  maxlength="200"
                />
                <PasswordField
                  v-model="form.password"
                  label="Password"
                  id="password"
                  maxlength="200"
                />

                <!-- Display error message for email field -->
                <!-- <div v-if="formErrors.password" class="text-red-500">
                {{ formErrors.password }}
              </div> -->
                <div class="py-1 my-1 font-yaraa text-sm">
                  <router-link v-if="isAdmin" to="/admin/password/forgot"
                    >Forgot password?</router-link
                  >
                  <router-link v-else to="/password/forgot">Forgot password?</router-link>
                </div>
                <button :disabled="isFormInvalid || isLoading" class="btn btn-primary">
                  {{ isLoading ? "Logging in..." : "Login" }}
                </button>
              </form>
            </div>
        </a-layout-content>
        <a-layout-footer :style="footerStyle">MyVault</a-layout-footer>
      </a-layout>
    </a-space>
</template>

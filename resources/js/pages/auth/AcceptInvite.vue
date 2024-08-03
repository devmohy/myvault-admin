<script setup>
import InputField from "@/components/InputField.vue";
import PasswordField from "@/components/PasswordField.vue";
import { reactive, ref, computed, onBeforeMount } from "vue";
import api from "@/api";
import { useToast } from "vue-toastification";
const toast = useToast();
import { useRoute, useRouter } from "vue-router";
import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();
const route = useRoute();
const router = useRouter();
const isLoading = ref(false);
const showForm = ref(false);
const form = reactive({
  first_name: "",
  last_name: "",
  password: "",
});

showForm.value = true;
const isFormInvalid = computed(() => {
  return form.first_name === "" || form.last_name === "" || form.password === "";
});

const validateInput = (type, value) => {
  const trimmedValue = value.trim();
  if (type === "first_name") {
    const formattedFirstName = trimmedValue.replace(/[^a-zA-Z-]/g, "");
    form.first_name = formattedFirstName;
  }
  if (type === "last_name") {
    const formattedLastName = trimmedValue.replace(/[^a-zA-Z-]/g, "");
    form.last_name = formattedLastName;
  }
  if (type === "password") {
    console.log(value);
    form.password = trimmedValue;
  }
};

const handleAcceptInvite = async () => {
  try {
    isLoading.value = true;
    const response = await api.post(
      `/team-members/invite/${route.query.inviteRef}/accept`,
      {
        first_name: form.first_name,
        last_name: form.last_name,
        password: form.password,
      }
    );
    if (isAdmin) {
      router.push("/admin/login");
    } else {
      router.push("/login");
    }
    toast.success(response.data.message);
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

const checkIfLinkIsvalid = async () => {
  try {
    isLoading.value = true;
    const response = await api.get(
      `/team-members/invite/${route.query.inviteRef}/check-link`
    );
    // toast.success(response.data.message);
  } catch (error) {
    showForm.value = false;
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
  backgroundColor: "#ff6600",
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
checkIfLinkIsvalid();
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
        <div
          class="w-full lg:w-1/3 mx-auto my-10 bg-[#FFFFFF] p-5 border-solid rounded-lg shadow-md"
        >
          <div class="w-full mx-auto">
            <div class="flex flex-col mb-6 gap-y-2">
              <h1 class="m-0 p-0 mb-2 text-3xl lg:text-3xl text-[#101828] font-semibold">
                {{ showForm ? "Complete your profile" : "Invalid invite link" }}
              </h1>
            </div>

            <form @submit.prevent="handleAcceptInvite" v-if="showForm">
              <div class="grid gap-x-6 md:grid-cols-2">
                <InputField
                  v-model="form.first_name"
                  id="first_name"
                  label="First name"
                  type="text"
                  placeholder="Enter your first name"
                  accept="alphabet"
                  maxlength="100"
                  @input="validateInput('first_name', $event.target.value)"
                />
                <InputField
                  v-model="form.last_name"
                  id="last_name"
                  label="Last name"
                  type="text"
                  placeholder="Enter your last name"
                  accept="alphabet"
                  maxlength="100"
                  @input="validateInput('last_name', $event.target.value)"
                />
              </div>

              <PasswordField
                id="password"
                v-model="form.password"
                label="Password"
                :validationRules="{
                  minLength: true,
                  uppercase: true,
                  lowercase: true,
                  specialCharacter: true,
                }"
                @input="validateInput('password', $event.target.value)"
              />
              <button :disabled="isFormInvalid || isLoading" class="btn btn-primary">
                {{ isLoading ? "Creating account..." : "Create my account" }}
              </button>
            </form>
          </div>
        </div>
      </a-layout-content>
      <a-layout-footer :style="footerStyle">MyVault</a-layout-footer>
    </a-layout>
  </a-space>
</template>

<!-- PasswordInput.vue -->
<template>
  <div class="mb-4">
    <label
      for="password"
      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
      >{{ props.label }}</label
    >
    <div class="relative">
      <div class="absolute inset-y-0 end-3 flex items-center ps-3.5">
        <button type="button" @click="togglePasswordVisibility(props.id)">
          <svg
            v-if="showPassword"
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            stroke="#000000"
          >
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
              id="SVGRepo_tracerCarrier"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12"
                stroke="#667085"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></path>
              <path
                d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12"
                stroke="#667085"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></path>
              <circle
                cx="12"
                cy="12"
                r="3"
                stroke="#667085"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></circle>
            </g>
          </svg>

          <svg
            v-else
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
              id="SVGRepo_tracerCarrier"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M2 2L22 22"
                stroke="#667085"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></path>
              <path
                d="M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335"
                stroke="#667085"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></path>
              <path
                d="M14 14.2362C13.4692 14.7112 12.7684 15.0001 12 15.0001C10.3431 15.0001 9 13.657 9 12.0001C9 11.1764 9.33193 10.4303 9.86932 9.88818"
                stroke="#667085"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></path>
            </g>
          </svg>
        </button>
      </div>
      <input
        v-model="password"
        type="password"
        :id="props.id"
        :name="props.name"
        @input="$emit('update:modelValue', $event.target.value), validatePassword"
        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="•••••••••"
        required
        maxlength="120"
      />
    </div>
    <div v-if="showValidationMessages" class="text-sm mt-2">
      <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
        <li
          v-if="validationRules?.minLength"
          class="flex"
          :class="{ 'text-[#00ace2]': isMinLengthValid }"
        >
          <svg
            class="w-3.5 h-3.5 me-2"
            :class="{
              'text-[#00ace2]': isMinLengthValid,
              'text-[#EAECF0]': !isMinLengthValid,
            }"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
            />
          </svg>
          Must be at least 8 characters
        </li>
        <li
          v-if="validationRules?.uppercase"
          class="flex"
          :class="{ 'text-[#00ace2]': isUppercaseValid }"
        >
          <svg
            class="w-3.5 h-3.5 me-2"
            :class="{
              'text-[#00ace2]': isUppercaseValid,
              'text-[#EAECF0]': !isUppercaseValid,
            }"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
            />
          </svg>
          Must contain at least an uppercase letter
        </li>
        <li
          v-if="validationRules?.lowercase"
          class="flex"
          :class="{ 'text-[#00ace2]': isLowercaseValid }"
        >
          <svg
            class="w-3.5 h-3.5 me-2"
            :class="{
              'text-[#00ace2]': isLowercaseValid,
              'text-[#EAECF0]': !isLowercaseValid,
            }"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
            />
          </svg>
          Must contain at least a lowercase letter
        </li>
        <li
          v-if="validationRules?.specialCharacter"
          class="flex"
          :class="{ 'text-[#00ace2]': isSpecialCharacterValid }"
        >
          <svg
            class="w-3.5 h-3.5 me-2"
            :class="{
              'text-[#00ace2]': isSpecialCharacterValid,
              'text-[#EAECF0]': !isSpecialCharacterValid,
            }"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
            />
          </svg>
          Must contain one special character (e.g., !”#$%&)
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";

const props = defineProps([
  "validationRules",
  "label",
  "placeholder",
  "modelValue",
  "name",
  "id",
]);

const password = ref("");
const showValidationMessages = ref(false);
const showPassword = ref(false);

const isMinLengthValid = ref(true);
const isUppercaseValid = ref(true);
const isLowercaseValid = ref(true);
const isSpecialCharacterValid = ref(true);
const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
  const passwordInput = document.getElementById(props.id);

  if (passwordInput) {
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";
  } else {
    console.error(`Element with id '${props.id}' not found.`);
  }
};
const validatePassword = () => {
  isMinLengthValid.value = password.value.length >= 8;
  isUppercaseValid.value = /[A-Z]/.test(password.value);
  isLowercaseValid.value = /[a-z]/.test(password.value);
  isSpecialCharacterValid.value = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password.value);

  showValidationMessages.value = true;
};

// Watch for changes in password and trigger validation
watch(password, validatePassword);

// Run initial validation when component is mounted
onMounted(validatePassword);
</script>

<style scoped>
/* Add your scoped styles here */
</style>

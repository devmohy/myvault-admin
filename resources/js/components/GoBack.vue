<script setup>
import { useRouter, useRoute } from 'vue-router'
const router = useRouter()
const goBack = (e) => {
  router.go(-1);
};
</script>
<template>
  <button
    type="button"
    @click="goBack"
    class="col-span-1 flex items-center p-2 text-gray-900 rounded-lg group"
  >
    <svg
      class="w-3 h-3 text-[#475467] dark:text-white"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 14 10"
    >
      <path
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M13 5H1m0 0 4 4M1 5l4-4"
      />
    </svg>
    <span class="flex-1 ms-3 text text-sm font-semibold text-[#475467] whitespace-nowrap"
      >Back</span
    >
  </button>
</template>

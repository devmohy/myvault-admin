<template>
  <div :id="id">
    <h2 :id="headingId">
      <button
        type="button"
        @click="toggleAccordion"
        :class="{ 'border-b-1 rounded-b-xl': !isActive, 'border-b-0': isActive }"
        :aria-expanded="isActive"
        :aria-controls="bodyId"
        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 rounded-t-xl"
      >
        <span class="text-base text-[#101828]">{{ props.title }}</span>
        <svg
          width="20"
          height="20"
          viewBox="0 0 20 20"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M17.5 13.75L10 6.25L2.5 13.75"
            stroke="#475467"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </button>
    </h2>
    <div :id="bodyId" :class="{ hidden: !isActive }" :aria-labelledby="headingId">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const isActive = ref(true);

const toggleAccordion = () => {
  isActive.value = !isActive.value;
};

const props = defineProps({
  id: String,
  title: String,
});

const id = ref("");
const headingId = ref("");
const bodyId = ref("");

onMounted(() => {
  id.value = `accordion-${Math.floor(Math.random() * 1000)}`;
  headingId.value = `${id.value}-heading`;
  bodyId.value = `${id.value}-body`;
});
</script>

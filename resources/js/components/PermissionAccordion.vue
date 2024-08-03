<template>
  <div>
    <h2 :id="headingId">
      <button
        type="button"
        :class="buttonClasses"
        :data-accordion-target="bodyId"
        :aria-expanded="isExpanded"
        :aria-controls="bodyId"
        @click="toggleAccordion"
      >
        <div class="flex p-0 m-0">
          <slot name="icon"></slot>
          <span class="mx-2 text-sm text-[#101828]">
            <slot name="title"></slot>
          </span>
        </div>
        <div class="flex item-center flex-row">
          <p class="pr-2 text-xs">
            <slot name="permissionsCount"></slot> Permissions
          </p>
          <svg
            data-accordion-icon
            class="w-3 h-3 rotate-180 shrink-0 mt-0.5"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 10 6"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5 5 1 1 5"
            />
          </svg>
        </div>
      </button>
    </h2>
    <div :id="bodyId" class="hidden" :aria-labelledby="headingId">
      <ul class="w-full text-sm font-normal text-[#475467]">
        <slot></slot>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const isExpanded = ref(false);
const headingId = `accordion-heading-${Math.random().toString(36).substr(2, 9)}`;
const bodyId = `accordion-body-${Math.random().toString(36).substr(2, 9)}`;

const buttonClasses = computed(() => {
  return `flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3 ${isExpanded.value ? 'bg-gray-200' : ''}`;
});

const toggleAccordion = () => {
  isExpanded.value = !isExpanded.value;
};
</script>

<style scoped>
/* Add your styling here if needed */
</style>

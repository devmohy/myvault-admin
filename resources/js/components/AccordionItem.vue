<template>
    <h2 :id="headingId">
      <button
        type="button"
        :class="buttonClasses"
        :data-accordion-target="bodyId"
        :aria-expanded="isExpanded"
        :aria-controls="bodyId"
        @click="toggleAccordion"
      >
        <div class="flex px-1 m-0">
          <slot name="icon" />
          <span class="mx-2 text-sm text-[#101828] capitalize">
            <slot name="title" />
          </span>
        </div>
        <div class="flex item-center flex-row">
          <p class="text-xs"><slot name="permissionsCount" /></p>
          <slot name="arrowIcon" />
        </div>
      </button>
    </h2>
    <div :id="bodyId" :class="isExpanded ? '' : 'hidden'" aria-labelledby="headingId">
      <slot name="checkboxes" />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import SvgIcon from '@/components/SvgIcons.vue';
const isExpanded = ref(false);
const headingId = `accordion-heading-${Math.random().toString(36).substr(2, 9)}`;
const bodyId = `accordion-body-${Math.random().toString(36).substr(2, 9)}`;

const buttonClasses = computed(() => {
  return `flex items-center justify-between w-full font-medium rtl:text-right gap-3}`;
});

const toggleAccordion = () => {
  isExpanded.value = !isExpanded.value;
};

</script>

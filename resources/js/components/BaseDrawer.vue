<template>
  <div
    :id="props.drawerId"
    :class="`fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform bg-white w-2/6 dark:bg-gray-800 translate-x-full`"
    tabindex="-1"
    aria-hidden="true"
    :aria-labelledby="props.drawerLabelId"
    
  >
    <h5 :id="props.drawerLabelId" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
      <slot name="title">Drawer Title</slot>
    </h5>
    <button
      type="button"
      :data-drawer-hide="props.drawerId"
      :aria-controls="props.drawerId"
      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
    >
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">Close menu</span>
    </button>
    <div class="mb-6">
      <slot name="content"></slot>
    </div>
  </div>
</template>

<script setup>
const getPositionClass = () => {
  // Default to 'right' if no position is provided
  return props.position || 'right';
};

const props = defineProps(['drawerId', 'drawerLabelId','position']);
</script>

<!-- SvgIcon.vue -->
<template>
  <div v-html="svgContent" class="svg-icon" />
</template>

<script setup>
import {computed} from 'vue'
import * as svgIcons from '../SvgIcons.js';

const props = defineProps(['icon']);

const svgContent = computed(() => {
  const selectedIcon = svgIcons[props.icon];
  if (selectedIcon) {
    return selectedIcon;
  } else {
    console.error(`SVG icon "${props.icon}" not found.`);
    return '';
  }
});
</script>

<style scoped>
.svg-icon {
  /* Add any styling if needed */
}
</style>
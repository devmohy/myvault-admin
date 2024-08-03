<template>
  <div>
    <div v-if="isPDF">
      <object :data="fileUrl" type="application/pdf" class="w-full h-screen">
        <p>PDF viewer not available. <a :href="fileUrl">Download PDF</a> instead.</p>
      </object>
    </div>
    <div v-else-if="isImage">
      <img :src="fileUrl" alt="Preview">
    </div>
    <div v-else>
      <p>File is invalid.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  fileUrl: {
    type: String,
    required: true
  },
  filePath: {
    type: String,
    required: true
  }
});

const isPDF = computed(() => {
  return props.filePath.toLowerCase().endsWith('.pdf');
});

const isImage = computed(() => {
  const extensions = ['.png', '.jpg', '.jpeg', '.gif'];
  const lowerCaseUrl = props.filePath.toLowerCase();
  return extensions.some(ext => lowerCaseUrl.endsWith(ext));
});
</script>

<style>
/* Add your custom styles here */
</style>

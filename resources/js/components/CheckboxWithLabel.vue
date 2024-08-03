<template>
  <li class="w-full">
    <div class="flex items-center ps-3">
      <label :for="checkboxId" :class="labelClasses">{{ label }}</label>
      <input
        :id="checkboxId"
        type="checkbox"
        v-model="isChecked"
        :class="checkboxClasses"
      />
    </div>
  </li>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps(['id', 'label']);

const checkboxId = ref(`checkbox-${props.id}`);
const isChecked = ref(false);


const labelClasses = 'w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-[#475467]';
const checkboxClasses = 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#00ace2] dark:focus:ring-[#00ace2] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500';
</script>

<style scoped>
li{
  list-style: none;
}
</style>
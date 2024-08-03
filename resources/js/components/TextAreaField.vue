<script setup>
defineProps({
  id: String,
  label: String,
  type: String,
  placeholder: String,
  inputClass: String,
  'onUpdate:modelValue': Function,
});
</script>
<template>
  <div class="mb-[16px]">
    <label
      :for="id"
      class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
      >{{ label }}</label
    >
    <textarea
      :id="id"
      rows="6"
      @input="$emit('update:modelValue',$event.target.value)"
      class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300"
      :placeholder="placeholder"
    ></textarea>
  </div>
</template>

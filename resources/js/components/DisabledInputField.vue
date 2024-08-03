<script setup>
defineProps({
    id: String,
    label: String,
    type: String,
    value: String,
    inputClass: String,
})
</script>
<template>
  <div class="mb-[16px]">
    <label
      :for="id"
      class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
      >{{ label }}</label
    >
    <input
      :type="type"
      :id="id"
      class="input-field p-[12px] text-[#667085]"
      :value="value"
      required
      disabled
    />
  </div>
</template>

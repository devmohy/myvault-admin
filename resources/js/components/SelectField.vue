<script setup>
const emit = defineEmits(['change'])
defineProps({
  id: String,
  label: String,
  placeholder: String,
  inputClass: String,
  options: Array,
  'onUpdate:modelValue': Function,
});

const handleChange = (e) => {
  emit("change", e.target.value)
  emit('update:modelValue',e.target.value)
}
</script>
<template>
  <div class="mb-[16px]">
    <label
      :for="id"
      class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
      >{{ label }}</label
    >
    <select
      :id="id"
      class="input-field p-[12px]"
      @change="handleChange"
    >
      <option disabled selected>{{ placeholder }}</option>
      <option v-for="(option, index) in options" :key="index" :value="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

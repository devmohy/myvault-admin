<script setup>
import { ref } from "vue";
import { useInputValidation } from "@/composables/useInputValidation";

const {
  validateInput,
} = useInputValidation();

import { defineEmits, defineProps } from 'vue';

const emit = defineEmits(['change']);

const props = defineProps({
  id: String,
  label: String,
  type: String,
  modelValue: String,
  errorMsg: String,
  successMsg: String,
  'onUpdate:modelValue': Function,
  accept: RegExp, // This is correct now
  maxDigits: String,
  maxLength: {
    type: Number,
    default: 500
  }
});

const change = (e) => {
    const inputValue = e.target.value;
    if (props.maxDigits && inputValue.length > props.maxDigits) {
        const truncatedValue = inputValue.slice(0, props.maxDigits);
        e.target.value = truncatedValue;
        emit('change', truncatedValue);
    } else {
        emit('change', inputValue);
    }
}

const handleInput = (e) => {
    let inputValue = e.target.value;
    // Validate input based on regex pattern and maxLength
    inputValue = validateInput(inputValue, props.accept, props.maxLength);
    emit('update:modelValue', inputValue);
    e.target.value = props.modelValue;
}
</script>

<template>
  <div class="mb-[16px]">
    <label
      :for="id"
      class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
    >{{ label }}</label>
    
    <input
      v-bind="$attrs"
      :type="type"
      class="input-field p-[12px]"
      :value="modelValue"
      @input="handleInput"
      required
      @change="change"
    />
    <div v-if="errorMsg" class="text-red-500 text-sm mt-1">{{ errorMsg }}</div>
    <div v-if="successMsg" class="text-green-500 text-sm mt-1">{{ successMsg }}</div>
  </div>
</template>

<script setup>
import { defineEmits, defineProps } from 'vue';

const emit = defineEmits(['search']);
const props = defineProps({
  id: String,
  label: String,
  type: String,
  placeholder: String,
  inputClass: String,
  handleSearch: Function,
  placeholder: String,
  searchValue: String
});

const search = (e) => {
  emit('search', e.target.value);
}

const clearSearch = () => {
  emit('search', ''); // Emit an empty string to clear the search
}
</script>

<template>
  <div class="bg-white">
    <label for="table-search" class="sr-only">Search</label>
    <div class="relative mt-1">
      <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
      </div>
      <input
        type="text"
        id="table-search"
        class="placeholder:text-slate-400 block pt-3 ps-10 py-3 text-sm text-gray-900 border border-gray-300 rounded-full focus:ring-gray-500 focus:border-gray-500"
        :placeholder="props.placeholder"
        :value="props.searchValue"
        @change="search"
      />
      <div class="absolute inset-y-0 rtl:inset-l-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
      </div>
      <button v-if="props.searchValue" @click="clearSearch" class="absolute inset-y-0 rtl:inset-l-0 end-0 flex items-center pe-3 cursor-pointer">
        <!-- Add a cancel button -->
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
</template>

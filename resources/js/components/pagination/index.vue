<template>
  <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
    <div class="flex flex-1 justify-between sm:hidden">
      <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50" @click="goToPage(pagination.current_page - 1)">Previous</a>
      <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50" @click="goToPage(pagination.current_page + 1)">Next</a>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">{{ startItem }}</span>
          to
          <span class="font-medium">{{ endItem }}</span>
          of
          <span class="font-medium">{{ pagination?.total }}</span>
          results
        </p>
      </div>
      <div>
        <nav class="isolate inline-flex -space-x-px rounded-md" aria-label="Pagination">
          <a v-for="page in displayedPages" :key="page" href="#" :class="{ 'bg-[#F9FAFB] text-[#182230] pagination-numbers': page === pagination.current_page, 'pagination-numbers hover:bg-gray-50 focus:z-20': page !== pagination.current_page }" @click="goToPage(page)">
            {{ page }}
          </a>
          <a v-if="pagination?.current_page > 1" href="#" class="relative inline-flex items-center rounded-full px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" @click="goToPage(pagination?.current_page - 1)">
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
          </a>
          <a v-if="pagination?.current_page < Math.ceil(pagination?.total / pagination?.per_page)" href="#" class="relative inline-flex items-center rounded-full px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" @click="goToPage(pagination?.current_page + 1)">
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
const emit = defineEmits(['pageChange'])
import { ref, watchEffect } from 'vue';

// Define props if needed
const { pagination } = defineProps(['pagination']);

// Calculate startItem and endItem dynamically
const startItem = ref((pagination?.current_page - 1) * pagination?.per_page + 1);
const endItem = ref(Math.min(pagination?.current_page * pagination?.per_page, pagination?.total));

// Calculate the displayed page numbers dynamically
const displayedPages = ref([]);

watchEffect(() => {
  const totalPages = Math.ceil(pagination?.total / pagination?.per_page);
  const currentPage = pagination?.current_page;

  let start = Math.max(1, currentPage - 2);
  let end = Math.min(currentPage + 2, totalPages);

  if (end - start < 4) {
    start = Math.max(1, end - 4);
  }

  displayedPages.value = Array.from({ length: end - start + 1 }, (_, i) => start + i);
});

// Function to handle page navigation
const goToPage = (page) => {
  if (page >= 1 && page <= Math.ceil(pagination?.total / pagination?.per_page)) {
    emit('pageChange', page);
    startItem.value = (page - 1) * pagination?.per_page + 1;
    endItem.value = Math.min(page * pagination?.per_page, pagination?.total);
  }
};

</script>

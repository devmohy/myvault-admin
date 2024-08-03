<template>
  <div
    v-if="pagination"
    class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
  >
    <!-- Previous Button -->
    <a
      v-if="pagination.prev_page_url"
      :href="pagination.prev_page_url"
      class="relative inline-flex items-center rounded-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
    >
      <span class="sr-only">Previous</span>
      <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path
          fill-rule="evenodd"
          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
          clip-rule="evenodd"
        />
      </svg>
    </a>

    <!-- Pagination Links -->
    <div>
      <nav
        class="isolate inline-flex -space-x-px rounded-md shadow-sm"
        aria-label="Pagination"
      >
        <!-- Dynamic Pagination Links -->
        <template v-if="totalPages > 0">
          <a
            v-for="page in totalPages"
            :key="page"
            :href="getPageLink(page)"
            :class="{
              'bg-green-600 text-white': page === pagination.current_page,
              'text-gray-900': page !== pagination.current_page,
            }"
            class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
          >
            {{ page }}
          </a>
        </template>
      </nav>
    </div>

    <!-- Next Button -->
    <a
      v-if="pagination.next_page_url"
      :href="pagination.next_page_url"
      class="relative inline-flex items-center rounded-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
    >
      <span class="sr-only">Next</span>
      <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path
          fill-rule="evenodd"
          d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
          clip-rule="evenodd"
        />
      </svg>
    </a>
  </div>
</template>

<script setup>
import { ref } from "vue";

const { pagination } = defineProps(["pagination"]);

const totalPages = ref(
  pagination ? Math.ceil(pagination.total / pagination.per_page) : 0
);

const getPageLink = (page) => {
  // Use next_page_url if available, otherwise generate the link
  return page === pagination.current_page
    ? "#"
    : pagination.next_page_url || `#page${page}`;
};
</script>

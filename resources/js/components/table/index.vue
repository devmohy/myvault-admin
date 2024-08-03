<script setup>
import { ref, watch } from "vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import SearchBar from "@/components/SearchBar.vue";
import FilterCard from "@/components/filter/index.vue";
import { onMounted } from "vue";
import ApproveDeclineModal from "@/components/role/ApproveAndDeclineModal.vue";
import { initFlowbite } from "flowbite";

defineProps({
  columns: Object,
  dataSource: Array,
  searchPlaceholder: String,
  searchValue:String,
  loading: Boolean,
  filterBtnName: String,
  showPageSizeChanger: Boolean,
  showSearch: Boolean,
  showFilter: Boolean,
  onRow: Function,
  scroll: Object,
  rowKey: [String, Function],
  setFilter: Function,
  setSearchTerm: Function,
  setPagination: Function,
  handleSearch: Function,
  handleFilter: Function,
  summary: Function,
});

onMounted(() => {
  initFlowbite();
});
</script>
<template>
  <div
    class="flex flex-column mx-4 my-4 sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4"
  >
    <SearchBar :searchValue="searchValue" v-if="showSearch" :placeholder="searchPlaceholder" @search="handleSearch" />
    <div class="flex flex-row gap-4">
      <slot name="noFilter"></slot>
      <FilterCard v-if="showFilter == true" @filter="handleFilter" />
    </div>
  </div>
  <div class="relative overflow-x-auto min-h-96">
    <table aria-describedby="datatable" class="w-full">
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th
            v-for="column in columns"
            :key="column.key"
            scope="col"
            class="px-6 py-3 whitespace-nowrap"
            :class="[`w-[${column.width}px]`, { truncate: column.key === 'description' }]"
          >
            <div class="flex items-center">
              {{ column.title }}
              <button v-if="column.sort" href="#" class="pl-1">
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 16 16"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10.93 9.66602H13.7373L10.93 12.9993H13.7373"
                    stroke="#475467"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M14 6.33333L12.3334 3L10.6667 6.33333"
                    stroke="#475467"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10.946 5.77474H13.7207"
                    stroke="#475467"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M8 12.9993H2"
                    stroke="#475467"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M8 9.66536H2"
                    stroke="#475467"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M8 6.33333H2"
                    stroke="#475467"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M8 2.99935H2"
                    stroke="#475467"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </button>
            </div>
          </th>
          <th class="px-6 py-3 whitespace-nowrap">
            <slot name="actionTitle"></slot>
          </th>
        </tr>
      </thead>
      <tbody v-if="dataSource.length > 0">
        <tr v-for="(item, index) in dataSource" :key="index" class="bg-white border-b">
          <td
            class="px-6 py-4 text-sm whitespace-nowrap min-w-[140px]"
            v-for="column in columns"
            :key="column.id"
            :class="[`w-[${column.width}px]`, { truncate: column.key === 'description' }]"
          >
            <StatusBadge
              v-if="column.key == 'status' || column.key == 'type' || column.key == 'mandatory'"
              :status="item[column.key]"
            />
            <span v-else>{{ item[column.key] }}</span>
          </td>
          <!-- Slot for actions -->
          <td class="px-6 py-4 text-sm whitespace-nowrap">
            <slot name="actions" :item="item"></slot>
          </td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr>
          <td colspan="5">
        <div 
          class="w-full min-h-[600px] text-center flex flex-col items-center justify-center content-center pb-6"
        >
          <div>
            <svg
              width="76"
              height="64"
              viewBox="0 0 76 64"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <g clip-path="url(#clip0_351_111427)">
                <path
                  d="M70.9268 0.5H25.2683C24.5679 0.5 24 0.947266 24 1.5V8.5C24 9.05273 24.5679 9.5 25.2683 9.5H74.7317C75.4321 9.5 76 9.05273 76 8.5V4.5C76 2.29395 73.7241 0.5 70.9268 0.5Z"
                  fill="#AB9FF7"
                />
                <path
                  d="M74.7333 7.5H36.2014L32.5938 2.51562C31.6939 1.27246 30.0079 0.5 28.1945 0.5H5.06667C2.27295 0.5 0 2.29395 0 4.5V51.5C0 53.7061 2.27295 55.5 5.06667 55.5H70.9333C73.7271 55.5 76 53.7061 76 51.5V8.5C76 7.94727 75.4328 7.5 74.7333 7.5Z"
                  fill="#CFBDFF"
                />
                <path
                  d="M29 7C29.5523 7 30 6.55228 30 6C30 5.44772 29.5523 5 29 5C28.4477 5 28 5.44772 28 6C28 6.55228 28.4477 7 29 7Z"
                  fill="#AB9FF7"
                />
                <path
                  d="M53.707 49.293L47.707 43.293C47.3164 42.9023 46.6836 42.9023 46.293 43.293L43.293 46.293C42.9023 46.6836 42.9023 47.3164 43.293 47.707L49.293 53.707C49.4883 53.9023 49.7441 54 50 54C50.2559 54 50.5117 53.9023 50.707 53.707L53.707 50.707C54.0977 50.3164 54.0977 49.6836 53.707 49.293Z"
                  fill="#FCDB88"
                />
                <path
                  d="M50.707 43.293L46.707 39.293C46.3164 38.9023 45.6836 38.9023 45.293 39.293L39.293 45.293C38.9023 45.6836 38.9023 46.3164 39.293 46.707L43.293 50.707C43.4883 50.9023 43.7441 51 44 51C44.2559 51 44.5117 50.9023 44.707 50.707L50.707 44.707C51.0977 44.3164 51.0977 43.6836 50.707 43.293Z"
                  fill="#F4C167"
                />
                <path
                  d="M31 50C41.4934 50 50 41.4934 50 31C50 20.5066 41.4934 12 31 12C20.5066 12 12 20.5066 12 31C12 41.4934 20.5066 50 31 50Z"
                  fill="#FCDB88"
                />
                <path
                  d="M31 45C38.732 45 45 38.732 45 31C45 23.268 38.732 17 31 17C23.268 17 17 23.268 17 31C17 38.732 23.268 45 31 45Z"
                  fill="#F4C167"
                />
                <path
                  d="M62.6714 56.2578L54.707 48.293C54.332 47.918 53.668 47.918 53.293 48.293L48.293 53.293C47.9023 53.6836 47.9023 54.3164 48.293 54.707L56.2573 62.6719C57.1138 63.5283 58.2524 64 59.4644 64C61.9653 64 64 61.9658 64 59.4648C64 58.2539 63.5283 57.1143 62.6714 56.2578Z"
                  fill="#F4C167"
                />
                <path
                  d="M32.4141 31L36.707 26.707C37.0977 26.3164 37.0977 25.6836 36.707 25.293C36.3164 24.9023 35.6836 24.9023 35.293 25.293L31 29.5859L26.707 25.293C26.3164 24.9023 25.6836 24.9023 25.293 25.293C24.9023 25.6836 24.9023 26.3164 25.293 26.707L29.5859 31L25.293 35.293C24.9023 35.6836 24.9023 36.3164 25.293 36.707C25.4883 36.9023 25.7441 37 26 37C26.2559 37 26.5117 36.9023 26.707 36.707L31 32.4141L35.293 36.707C35.4883 36.9023 35.7441 37 36 37C36.2559 37 36.5117 36.9023 36.707 36.707C37.0977 36.3164 37.0977 35.6836 36.707 35.293L32.4141 31Z"
                  fill="#FF8278"
                />
              </g>
              <defs>
                <clipPath id="clip0_351_111427">
                  <rect width="76" height="64" fill="white" />
                </clipPath>
              </defs>
            </svg>
          </div>
          <div class="text text-center w-96">
            <p class="text text-base font-semibold text-[#101828]">
              <slot name="empty-table-message-title">No results to show</slot>
            </p>
            <p class="text text-[#475467] font-normal">
              <slot name="empty-table-message-body"
                >There are no results for this query. Try resetting your filters or using
                a different query.</slot
              >
            </p>
          </div>
        </div>
      </td>
      </tr>
      </tbody>
    </table>
  </div>

  <div
    id="filter-drawer-right"
    class="fixed md:bottom-0 bottom-4 md:top-0 top-6 md:rounded-none rounded-md md:right-0 z-40 md:h-screen h-auto p-4 overflow-y-auto transform translate-x-full transition-transform bg-white w-[95%] right-3 md:w-2/6 dark:bg-gray-800"
    tabindex="-1"
    aria-labelledby="drawer-right-label"
  >
    <h5
      id="drawer-right-label"
      class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"
    >
      Filter
    </h5>
    <button
      type="button"
      data-drawer-hide="filter-drawer-right"
      aria-controls="filter-drawer-right"
      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
    >
      <svg
        class="w-3 h-3"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 14 14"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
        />
      </svg>
      <span class="sr-only">Close menu</span>
    </button>
    <slot name="filter"></slot>
  </div>
  <!-- 

  <ApproveDeclineModal :actionWord="actionWord" /> -->
</template>

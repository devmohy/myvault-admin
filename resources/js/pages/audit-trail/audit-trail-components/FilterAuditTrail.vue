<script setup>
import InputField from "@/components/InputField.vue";
</script>
<template>
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
    <form class="mb-6">
        <div class="mb-6 text-sm font-medium text-gray-900 dark:text-white">
        <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event type</label>
        <select id="roles" v-model="filters.event_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Select event type</option>
            <option value="owner">Create Payroll</option>
        </select>
      </div>
      <div class="relative mb-6 text-sm font-medium text-gray-900 dark:text-white">
            <div class="absolute inset-y-10 end-2 flex ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <label for="date-p" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employment
                date</label>
            <input datepicker datepicker-autohide type="text" id="date-p"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
      </div>
      <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
        <button
          data-drawer-hide="filter-drawer-right"
          aria-controls="filter-drawer-right"
          type="submit"
          class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="text-[#FFFFFF] bg-[#00ace2] hover:bg-[#00ace2] focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-[#F2F4F7] dark:hover:bg-[#F2F4F7] focus:outline-none dark:focus:ring-[#F2F4F7] block"
        >
          Apply filters 
        </button>
      </div>
    </form>
  </div>
</template>
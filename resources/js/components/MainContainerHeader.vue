<script setup>
import { stringify } from "postcss";
import { ref, computed, onMounted } from "vue";
import SvgIcons from "@/components/SvgIcons.vue";
const props = defineProps({
  page: String,
  pageBtnAction: String,
  btnIcon: String,
  hasBtn: Boolean,
  drawerTarget: String,
  btnType: String,
  tabs: Object,
  statuses: Array,
  activeTabKey: Number,
  handleActiveTab: Function,
  handleBtn: Function,
});
const allStatuses = computed(() => {
  const statuses = new Set(props.statuses);
  props.tabs.forEach(tab => statuses.add(tab.status));
  return Array.from(statuses);
});

function getCountByStatus(status) {
  if (status === 'all') {
    return props.tabs.reduce((total, tab) => total + tab.count, 0);
  } else {
    const tab = props.tabs.find(tab => tab.status === status);
    return tab ? tab.count : 0;
  }
}
</script>
<template>
  <div
    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0 pb-4 pt-8 bg dark:bg-gray-900"
  >
    <div class="text-2xl font-semibold">
      {{ page }}
    </div>
    <div>
      <button
        id="dropdownDefaultButton"
        data-dropdown-toggle="dropdown"
        type="button"
        v-if="hasBtn && btnType === 'action'"
        @click="handleBtn"
        class="btn btn-primary w-auto flex items-center px-4 py-3"
      >
        <SvgIcons :icon="btnIcon" />
        {{ pageBtnAction }}
      </button>
      <button
        type="button"
        v-if="hasBtn && btnType === 'drawer'"
        :data-modal-target="drawerTarget"
        :data-drawer-target="drawerTarget" :data-drawer-show="drawerTarget"
                        data-drawer-placement="right" :aria-controls="drawerTarget"
        class="btn btn-primary flex items-center px-4 py-3"
      >
        <svg
          class="w-4 h-4 me-2 text-white-800 dark:text-white"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 20 20"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
          />
        </svg>
        {{ pageBtnAction }}
      </button>
      <button
        v-if="hasBtn && btnType === 'filter'"
        id="dropdownRadioButton"
        data-dropdown-toggle="dropdownRadio"
        class="inline-flex items-center w-auto text-gray-500 shadow-sm border px-3 py-3 rounded-full"
        type="button"
      >
        <svg
          width="20"
          height="20"
          viewBox="0 0 20 20"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M13.3333 1.66699V5.00033"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M6.66667 1.66699V5.00033"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M2.5 7.49967H17.5"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M15.8333 3.33301H4.16667C3.24583 3.33301 2.5 4.07884 2.5 4.99967V15.833C2.5 16.7538 3.24583 17.4997 4.16667 17.4997H15.8333C16.7542 17.4997 17.5 16.7538 17.5 15.833V4.99967C17.5 4.07884 16.7542 3.33301 15.8333 3.33301Z"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M5.84418 10.6077C5.72918 10.6077 5.63585 10.7011 5.63668 10.8161C5.63668 10.9311 5.73001 11.0244 5.84501 11.0244C5.96001 11.0244 6.05335 10.9311 6.05335 10.8161C6.05335 10.7011 5.96001 10.6077 5.84418 10.6077"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M10.0108 10.6077C9.89581 10.6077 9.80247 10.7011 9.80331 10.8161C9.80331 10.9311 9.89664 11.0244 10.0116 11.0244C10.1266 11.0244 10.22 10.9311 10.22 10.8161C10.22 10.7011 10.1266 10.6077 10.0108 10.6077"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M14.1776 10.6077C14.0626 10.6077 13.9692 10.7011 13.9701 10.8161C13.9701 10.9311 14.0634 11.0244 14.1784 11.0244C14.2934 11.0244 14.3867 10.9311 14.3867 10.8161C14.3867 10.7011 14.2934 10.6077 14.1776 10.6077"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M5.84418 13.9408C5.72918 13.9408 5.63585 14.0341 5.63668 14.1491C5.63668 14.2641 5.73001 14.3574 5.84501 14.3574C5.96001 14.3574 6.05335 14.2641 6.05335 14.1491C6.05335 14.0341 5.96001 13.9408 5.84418 13.9408"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M10.0108 13.9408C9.89581 13.9408 9.80247 14.0341 9.80331 14.1491C9.80331 14.2641 9.89664 14.3574 10.0116 14.3574C10.1266 14.3574 10.22 14.2641 10.22 14.1491C10.22 14.0341 10.1266 13.9408 10.0108 13.9408"
            stroke="#323232"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
        This week
      </button>
      <!-- Dropdown menu -->
      <div
        id="dropdownRadio"
        class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
        data-popper-reference-hidden=""
        data-popper-escaped=""
        data-popper-placement="top"
        style="
          position: absolute;
          inset: auto auto 0px 0px;
          margin: 0px;
          transform: translate3d(522.5px, 3847.5px, 0px);
        "
      >
        <ul
          class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
          aria-labelledby="dropdownRadioButton"
        >
          <li>
            <div
              class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
            >
              <input
                id="filter-radio-example-1"
                type="radio"
                value=""
                name="filter-radio"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label
                for="filter-radio-example-1"
                class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >Last day</label
              >
            </div>
          </li>
          <li>
            <div
              class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
            >
              <input
                checked=""
                id="filter-radio-example-2"
                type="radio"
                value=""
                name="filter-radio"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label
                for="filter-radio-example-2"
                class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >Last 7 days</label
              >
            </div>
          </li>
          <li>
            <div
              class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
            >
              <input
                id="filter-radio-example-3"
                type="radio"
                value=""
                name="filter-radio"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label
                for="filter-radio-example-3"
                class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >Last 30 days</label
              >
            </div>
          </li>
          <li>
            <div
              class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
            >
              <input
                id="filter-radio-example-4"
                type="radio"
                value=""
                name="filter-radio"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label
                for="filter-radio-example-4"
                class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >Last month</label
              >
            </div>
          </li>
          <li>
            <div
              class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
            >
              <input
                id="filter-radio-example-5"
                type="radio"
                value=""
                name="filter-radio"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label
                for="filter-radio-example-5"
                class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                >Last year</label
              >
            </div>
          </li>
        </ul>
      </div>
      <div
        id="dropdown"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
      >
        <ul
          class="py-2 text-sm text-gray-700 dark:text-gray-200"
          aria-labelledby="dropdownDefaultButton"
        >
          <slot> </slot>
        </ul>
      </div>
    </div>
  </div>
  <slot name="summary"></slot>
  <div
    v-if="tabs?.length > 0"
    class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-4 mt-5"
  >
    <ul class="flex overflow-x-auto -mb-px">
      <li v-for="(status, index) in allStatuses" :key="index" class="me-2">
        <a
          href="#"
          :class="[
            'inline-block',
            'rounded-t-lg',
            { 'border-b-2 border-[#00ace2]': status === activeTabKey },
          ]"
          @click.prevent="handleActiveTab(status)"
        >
          <div
            class="inline-flex items-center px-3 py-2 text-center"
            :class="{
              'text-[#2E637A]': status === activeTabKey,
              'text-[#667085]': status !== activeTabKey,
              'hover:bg-gray-200': status !== activeTabKey,
              'bg-[#F8FBFC]': status === activeTabKey,
            }"
          >
            <span class="capitalize">{{ status }}</span>
            <span
              class="inline-flex items-center justify-center w-4 h-4 px-5 py-2.5 ml-3 bg-[#E9F2F7] rounded-full border"
              :class="{
                'text-[#2E637A]': status === activeTabKey,
                'text-[#344054]': status !== activeTabKey,
                'border-[#9FC9DB]': status === activeTabKey,
                'border-[#EAECF0]': status !== activeTabKey,
                'bg-[#E9F2F7]': status === activeTabKey,
                'bg-[#F9FAFB]': status !== activeTabKey,
              }"
            >
              {{ getCountByStatus(status) }}
            </span>
          </div>
        </a>
      </li>
    </ul>
  </div>
</template>

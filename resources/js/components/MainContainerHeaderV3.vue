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
      <slot></slot>
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

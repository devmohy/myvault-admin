<script setup>
const props = defineProps({
  page: String,
  btnIcon: String,
  hasBtn: Boolean,
  tabs: Object,
  activeTabKey: Number,
  handleActiveTab: Function,
  handleBtn: Function,
});
</script>
<template>
  <div
    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0 pb-4 pt-8 bg dark:bg-gray-900"
  >
    <div class="text-2xl font-semibold">
      {{ page }}
    </div>
    <div>
      <slot name="button" v-if="hasBtn"></slot>
    </div>
  </div>
  <slot name="summary"></slot>
  <div
    v-if="tabs?.length > 0"
    class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-4 mt-5"
  >
    <ul class="flex overflow-x-auto -mb-px">
      <li v-for="tab in tabs" :key="tab.title" class="me-2">
        <a
          href="#"
          :class="[
            'inline-block',
            'rounded-t-lg',
            { 'border-b-2 border-[#00ace2]': tab.title === activeTabKey },
          ]"
          aria-current="page"
          @click="handleActiveTab(tab)"
        >
          <div
            class="inline-flex items-center px-3 py-2 text-center"
            :class="{
              'text-[#2E637A]': tab.title === activeTabKey,
              'text-[#667085]': tab.title !== activeTabKey,
              'hover:bg-gray-200': tab.title !== activeTabKey,
              'bg-[#F8FBFC]': tab.title === activeTabKey,
            }"
          >
            <span class="capitalize">{{ tab.title }}</span>
            <span
              class="inline-flex items-center justify-center w-4 h-4 px-5 py-2.5 ml-3 bg-[#E9F2F7] rounded-full border"
              :class="{
                'text-[#2E637A]': tab.title === activeTabKey,
                'text-[#344054]': tab.title !== activeTabKey,
                'border-[#9FC9DB]': tab.title === activeTabKey,
                'border-[#EAECF0]': tab.title !== activeTabKey,
                'bg-[#E9F2F7]': tab.title === activeTabKey,
                'bg-[#F9FAFB]': tab.title !== activeTabKey,
              }"
            >
              {{ tab.count }}
            </span>
          </div>
        </a>
      </li>
    </ul>
  </div>
</template>

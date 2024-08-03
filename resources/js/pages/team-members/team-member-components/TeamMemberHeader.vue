<script setup>
import InviteTeamMemberDrawer from "@/pages/team-members/team-member-components/InviteTeamMemberDrawer.vue";
const props = defineProps({
  page: String,
  pageBtnAction: String,
  hasBotton: Boolean,
});
</script>
<template>
    <div
    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 pt-8 bg dark:bg-gray-900"
  >
    <div class="text-2xl font-semibold">
      {{ props.page }}
    </div>
    <div>
      <button
        type="button"
        v-if="hasBotton"
        data-drawer-target="invite-team-member-drawer-right" data-drawer-show="invite-team-member-drawer-right"
                        data-drawer-placement="right" aria-controls="invite-team-member-drawer-right"
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
        {{ props.pageBtnAction }}
      </button>

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
    <InviteTeamMemberDrawer />
  </div>
</template>
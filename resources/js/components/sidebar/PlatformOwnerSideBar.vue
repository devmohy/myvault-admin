<script setup>
import { ref, computed } from "vue";
import SvgIcon from "@/components/SvgIcons.vue";
import sidebars from "../../adminSideBar.js";
import { can } from "@/utils/permissions";
const filteredSidebars = computed(() => {
  // Filtering sidebars based on permissions
  return sidebars.map((sidebar) => {
    return sidebar.filter((item) => {
      return can(item.permission);
    });
  });
});
</script>
<template>
  <button
    data-drawer-target="separator-sidebar"
    data-drawer-toggle="separator-sidebar"
    aria-controls="separator-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
  >
    <span class="sr-only">Open sidebar</span>
    <svg
      class="w-6 h-6"
      aria-hidden="true"
      fill="currentColor"
      viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        clip-rule="evenodd"
        fill-rule="evenodd"
        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
      ></path>
    </svg>
  </button>

  <aside
    id="separator-sidebar"
    class="fixed left-0 z-40 md:z-10 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar"
  >
    <div class="h-full px-3 py-4 overflow-y-auto bg-[#F8F8F8]">
      <div class="max-w-sm pt-4">
        <img alt="MyVault logo" src="@assets/logo.png" width="150" />
      </div>
      <!-- <AuthUser /> -->
      <ul class="space-y-2 pt-3 font-medium">
        <li v-if="can('view_dashboard')">
          <router-link to="/admin/dashboard" class="nav-link" active-class="active">
            <SvgIcon icon="dashboard" />
            <span class="ms-3">Dashboard</span>
          </router-link>
        </li>
      </ul>
      <template v-for="sidebar in filteredSidebars">
        <ul
          v-if="sidebar.length"
          :key="sidebar[0].permission"
          class="pt-4 mt-2 space-y-2 font-medium text-sm border-t border-gray-200"
        >
          <li v-for="item in sidebar" :key="item.title">
            <router-link :to="item.route" class="nav-link" active-class="active">
              <SvgIcon :icon="item.icon" />
              <span class="flex-1 ms-3 whitespace-nowrap">{{ item.title }}</span>
            </router-link>
          </li>
        </ul>
      </template>
    </div>
  </aside>
</template>

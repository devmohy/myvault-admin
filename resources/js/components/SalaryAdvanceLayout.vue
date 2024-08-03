<script setup>
import SideBar from "@/components/sidebar/Index.vue";
import { ref, onMounted, computed } from "vue";
import { useUserAccess } from '@/utils/userAccess';
import { initFlowbite, initModals } from "flowbite";
import {useAuthStore} from '@/stores/auth';
const authStore = useAuthStore();
const kybVerified = authStore.user.business?.has_completed_kyb;

const { isAdmin } = useUserAccess();
// initialize components based on data attribute selectors
onMounted(() => {
  // initFlowbite();
});
</script>
<template>
  <div class="bg-[#F8F8F8]">    
    <SideBar/>
    <div class="px-6 pt-6 sm:ml-60">
      <div class="p-4 min-h-[90vh] bg-[#FFFFFF] rounded-lg overflow-y-scroll no-scrollbar">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import ProfileTabPage from "@/pages/settings/tabs/Profile.vue";
import { ref, onMounted } from "vue";
import { initFlowbite, initModals } from "flowbite";

const hasBotton = ref(false);
const activeKey = ref("1");
onMounted(() => {
  initFlowbite()
});
</script>

<template>
  <AppLayout>
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Settings"
        @back="() => $router.go(-1)"
      >
        <template #extra>
          <!-- <a-button key="1">Invite Member</a-button> -->
        </template>
      </a-page-header>
    </template>

    <a-tabs v-model:activeKey="activeKey">
        <a-tab-pane key="1" tab="Profile"> 
          <ProfileTabPage />
        </a-tab-pane>
    </a-tabs>
  </AppLayout>
</template>

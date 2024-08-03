<template>
  <a-layout has-sider>
    <a-layout-sider
      :style="{ overflow: 'auto', height: '100vh', position: 'fixed', left: 0, top: 0, bottom: 0 }"
    >
      <SideBar />
    </a-layout-sider>
    <a-layout :style="{ marginLeft: '200px' }">
      <a-layout-header style="background: #fff; padding: 0; height:50px">
        
      </a-layout-header>
      <a-layout-content style="margin: 0 16px">
        <slot name="pageHeader"></slot>
        <div class="min-h-screen bg-[#FFFFFF] rounded-lg overflow-y-scroll no-scrollbar p-4">
          <slot></slot>
        </div>
      </a-layout-content>
      <a-layout-footer style="text-align: center">
        &copy; MyVault
      </a-layout-footer>
    </a-layout>
  </a-layout>
</template>
<script setup>
import SideBar from '@/components/sidebar/Index.vue';
import { ref } from 'vue';
const collapsed = ref(false);
const selectedKeys = ref(['1']);
</script>
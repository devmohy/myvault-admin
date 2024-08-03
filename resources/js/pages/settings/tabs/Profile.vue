<script setup>
import Profile from "@/components/settings/profile/Profile.vue";
import ChangePassword from "@/components/settings/profile/ChangePassword.vue";
import { useAuthStore } from "@/stores/auth";
const user = useAuthStore().user;
</script>
<template>
  <div>
    <Profile />
    <ChangePassword />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import SvgIcon from '@/components/SvgIcons.vue';
import {useRouter} from 'vue-router';
import { useAuthStore } from "@/stores/auth";
const router = useRouter();
import { useUserAccess } from '@/utils/userAccess';
const { isAdmin } = useUserAccess();

const isDropdownOpen = ref(false);
const user = useAuthStore().user;

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

const logout = () => {
  useAuthStore().logout()
  if(user.type =='business'){
    router.push('/login')
  }else{
    router.push('/admin/login')
  }
};
</script>
<template>
  <div class="relative" @click="toggleDropdown">
    <div class="pt-4">
      <div class="pt-6">
        <a
          href="#"
          class="w-[220px] p-2 bg-white border border-gray-200 rounded-lg shadow focus:boder-[#7AB4CD]  flex justify-between"
        >
          <div>
            <h5 class="text-[#101828] text-base font-medium">{{ user?.business?.business_name ?? 'PaywithTransfer Admin' }}</h5>
            <p class="font-normal text-sm text-[#475467]">
              {{ user.first_name }}
            </p>
          </div>
          <span class="ml-2">
            <SvgIcon  v-if="!isDropdownOpen" icon="arrowDown" />
            <SvgIcon  v-else icon="arrowUp" />
          </span>
        </a>
      </div>
    </div>

    <!-- Dropdown Menu -->
    <div v-if="isDropdownOpen" class="absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-md w-[220px] z-10">
      <ul
        class="mt-2 p-2 space-y-2 font-medium text-sm border-b border-gray-200"
      >
        <li>
          <router-link v-if="user.type =='business'"
            to="/settings"
            class="nav-link"
            active-class="active"
          >
          <SvgIcon icon="profile" />
            <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
          </router-link>
          <router-link v-else
            to="/admin/settings"
            class="nav-link"
            active-class="active"
          >
          <SvgIcon icon="profile" />
            <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
          </router-link>
        </li>
        <!-- <li v-if="user.type =='business'">
          <router-link
            to="#"
            class="nav-link"
            active-class="active"
          >
          <SvgIcon icon="climateStars" />
            <span class="flex-1 ms-3 whitespace-nowrap">What’s new?</span>
          </router-link>
        </li> -->
      </ul>
      <ul
        class="mt-2 p-2 space-y-2 font-medium text-sm border-b border-gray-200" v-if="user.type =='business'"
      >
        <li v-if="user.type =='business'">
          <router-link
            to="#"
            class="nav-link"
            active-class="active"
          >
          <SvgIcon icon="supportChat" />
            <span class="flex-1 ms-3 whitespace-nowrap">Chat with support</span>
          </router-link>
        </li>
        <li v-if="user.type =='business'">
          <router-link
            to="#"
            class="nav-link"
            active-class="active"
          >
          <SvgIcon icon="faq" />
            <span class="flex-1 ms-3 whitespace-nowrap">FAQs</span>
          </router-link>
        </li>
      </ul>
      <ul
        class="mt-2 p-2 space-y-2 font-medium text-sm border-b border-gray-200"
      >
        <li>
          <a
            href="#"
            class="nav-link"
            active-class="active"
            @click.prevent="logout"
          >
          <SvgIcon icon="logout" />
            <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>


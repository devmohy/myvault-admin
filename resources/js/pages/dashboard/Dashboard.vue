<script setup>
import BusinessLayout from "@/layout/AppLayout.vue";
import PageHeader from "@/components/MainContainerHeader.vue";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();
import { ref, onMounted } from "vue";
import ChartComponent from "@/components/ChartComponent.vue";
import { useGenderData } from "@/composables/useGenderData";
import { useChartData } from '@/composables/useChartData';
const { data: savingsData, loading:savingsChartLoading, fetchData: fetchSavingsData } = useChartData('/dashboard/stats/savings');
const { data: genderData, loading:genderChartLoading, fetchData: fetchGenderData } = useChartData('dashboard/stats/gender');
import { initFlowbite } from "flowbite";
import api from "@/api";

const summaries = ref([]);

// const { genderData, genderLoading, getGenderData } = useGenderData();

const getStats = async () => {
  try {
    // isLoading.value = true;

    await api.get("/dashboard/stat").then((response) => {
      summaries.value = response.data.data;
    });
  } catch (error) {
    console.log("error: ", error);
    // toast.error(error.response.data.message);
  } finally {
    // isLoading.value = false;
  }
};

function copyToClipboard() {
  // Get the text field
  let copyText = document.getElementById("virtual_account_number").innerHTML;

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText);
}

getStats();

// initialize components based on data attribute selectors
onMounted(() => {
  initFlowbite();
  fetchGenderData();
  fetchSavingsData();
});
const business = authStore.user.business;
const kybVerified = authStore.user.business?.has_completed_kyb;
const showTour = ref(true);
</script>

<template>
  <BusinessLayout>
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Dashboard"
      >
        <template #extra>
          <!-- <a-button key="1" type="primary">Primary</a-button> -->
        </template>
      </a-page-header>
    </template>
    <div class="w-full grid grid-cols-1 lg:grid-cols-3 gap-5 p-4">
      <div
        v-for="(summary, index) in summaries"
        :key="index"
        class="p-4 bg-white border border-gray-100 rounded-lg shadow sm:p-8"
      >
        <div class="flex items-center justify-between mb-1">
          <h5 class="text-sm text-gray-900 dark:text-white">{{ summary.title }}</h5>
        </div>
        <div class="flex items-center">
          <div class="flex-1 min-w-0">
            <p class="lg:text-xl text-gray-900 font-medium">{{ summary.total }}</p>
          </div>
        </div>
        <div class="flex items-center gap-1 text-[11px] text-neutral-dark-300">
          <div class="flex items-center gap-1 text-green-500">
            <div>
              <i class="ph ph-trend-up flex"></i>
            </div>
            <div>0%</div>
          </div>
          <div class="an-label">vs last period</div>
        </div>
      </div>
      <div class="p-4 bg-white border border-gray-100 rounded-lg shadow lg:p-2">
        <ChartComponent
        chartType="bar"
        :chartData="savingsData.data"
        :labels="savingsData.labels"
        endingShape="rounded"
        title="Monthly Savings"
      />
      </div>
      <div class="p-4 bg-white border border-gray-100 rounded-lg shadow lg:p-2">
        <ChartComponent
          chartType="pie"
          :chartData="genderData.data"
          :labels="genderData.labels"
        />
      </div>
    </div>
  </BusinessLayout>
</template>

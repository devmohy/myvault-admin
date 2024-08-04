<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import Pagination from "@/components/pagination/index.vue";
import PageHeader from "@/components/MainContainerHeaderV2.vue";
import DataTable from "@/components/table/index.vue";
import EmptyTable from "@/components/table/empty.vue";
import { ref, onMounted, computed } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();;
import { useSavings } from "@/composables/useSavings";
import { can } from "@/utils/permissions";
import columns from "@/columns/savings";
import { initFlowbite } from "flowbite";
const {
    savings,
    pagination,
    search,
    filters,
    fetchSavings,
    fetchSaving,
    setPage,
    isLoading,
} = useSavings();
const router = useRouter();
const route = useRoute();
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();

const activeTabKey = ref('all');
const isFilter = ref(false);

const handleBookLoanBtn = () => {
  router.push("/loans/book");
};
function handleSearch(searchTerm) {
    search.value = searchTerm;
    isFilter.value = true;
    fetchSavings();
}

const dateValue = ref([]);
const formatter = ref({
  date: "DD MMM YYYY",
  month: "MMM",
});

const handleFilter = async () => {
  isFilter.value = true;
  setPage(1);
  await fetchSavings();
  filters.value = {
    date_range: []
  }
};
onMounted(() => {
  initFlowbite()
  fetchSavings()
});
</script>

<template>
  <AppLayout>
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Plans"
        sub-title="List of plans"
        @back="() => $router.go(-1)"
      >
        <template #extra>
          <!-- <a-button key="1" type="primary">Primary</a-button> -->
        </template>
      </a-page-header>
    </template>
    <a-table
      :columns="columns"
      :row-key="(record) => record.id"
      :data-source="savings"
      :pagination="pagination"
      :loading="isLoading"
      @change="handleTableChange"
    >
    <template #bodyCell="{ column, text, record }">
        <template v-if="column.dataIndex === 'customer'">
          <router-link :to="'/customers/' + record?.id">{{ record.customer_name }}</router-link><br/>
          <span>{{ record.customer_email }}</span><br/>
          <span>{{ record.customer_phone_number }}</span>
        </template>
        <template v-if="column.dataIndex === 'status'">
          <a-tag color="processing" v-if="record.active">ACTIVE</a-tag>
          <a-tag color="red" v-else>IN ACTIVE</a-tag>
        </template>

      </template>
    </a-table>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import Pagination from "@/components/pagination/index.vue";
import PageHeader from "@/components/MainContainerHeaderV2.vue";
import DataTable from "@/components/table/index.vue";
import EmptyTable from "@/components/table/empty.vue";
import ExportTransactionModal from "@/pages/transaction/transaction-components/ExportModal.vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import InputField from "@/components/InputField.vue";
import SelectField from "@/components/SelectField.vue";
import AmountField from "@/components/AmountField.vue";
import DateInputField from "@/components/DateInputField.vue";
import { ref, onMounted, computed } from "vue";
import { useToast } from "vue-toastification";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useUserAccess } from "@/utils/userAccess";
import columns from "@/columns/transaction";
const { isAdmin } = useUserAccess();
import { can } from "@/utils/permissions";
import { initFlowbite } from "flowbite";
import { useTransactions } from "@/composables/useTransactions";
import api from "@/api";
const {
  transactions,
  stats,
  sumStats,
  search,
  filters,
  fetchTransactions,
  fetchTransactionStat,
  fetchTransactionSumStat,
  isLoading,
  pagination,
  setPage,
} = useTransactions();

const router = useRouter();
const route = useRoute();
const toast = useToast();
const authStore = useAuthStore();

const isFilter = ref(false);

const activeTabKey = ref("all");

const handleBookLoanBtn = () => {
  router.push("/loans/book");
};


const dataSource = ref([]);
const loading = ref(false);
const current = ref(1);
const pageSize = ref(10); // Assuming default page size is 10, adjust as needed

// // Initially fetch records
// fetchCustomers();

fetchTransactions();

const handleTableChange = (pag, filters, sorter) => {
  current.value = pag.current;
  setPage(current.value);
  fetchTransactions();
};

const formatter = ref({
  date: "DD MMM YYYY",
  month: "MMM",
});

const handleFilter = async () => {
  isFilter.value = true;
  setPage(1);
  await fetchTransactions();
  filters.value = {
    date_range: [],
  };
};

function handleSearch(searchTerm) {
  search.value = searchTerm;
  isFilter.value = true;
  fetchTransactions();
}

function handlePageChange(page) {
  setPage(page);
  fetchTransactions();
}

const handleActiveTab = async (item) => {
  isFilter.value = true;
  activeTabKey.value = item;
  filters.value = {
    status: item,
  };
  await fetchTransactions();
};

const statuses = ["all", "successful", "pending", "failed"];


function formatPrice(value) {
  let val = (value / 1).toFixed(2).replace(".", ".");
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

onMounted(() => {
  initFlowbite();
});

// const handleTableChange = (pag, filters, sorter) => {
//   current.value = pag.current;
//   setPage(current.value);
//   fetchTransactions();
// };
</script>

<template>
  <AppLayout>
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Transactions"
        sub-title="List of transaction"
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
      :data-source="transactions"
      :pagination="pagination"
      :loading="isLoading"
      @change="handleTableChange"
    >
      <template #bodyCell="{ column, text, record }">
        <template v-if="column.dataIndex === 'user_name'">
          <router-link :to="'/customers/' + record?.id">{{ text }}</router-link>
        </template>
        <template v-if="column.dataIndex === 'type'">
          <a-tag color="success" v-if="text.toLowerCase() == 'credit'">{{ text }}</a-tag>
          <a-tag color="red" v-if="text.toLowerCase() == 'debit'">{{ text }}</a-tag>
        </template>
        <template v-if="column.dataIndex === 'type'"
          >-
          <a-tag color="processing">{{ record.group }}</a-tag>
        </template>
        <template v-if="column.dataIndex === 'status'">
          <a-tag color="warning" v-if="text.toLowerCase() == 'pending'">{{ text }}</a-tag>
          <a-tag color="success" v-if="text.toLowerCase() == 'successful'">{{ text }}</a-tag>
        </template>
        <template v-if="column.dataIndex === 'status' && record.category"
          >-
          <a-tag color="processing">{{ record.category }}</a-tag>
        </template>
      </template>
    </a-table>
  </AppLayout>
</template>

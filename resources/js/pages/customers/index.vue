<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import { ref, computed } from "vue";
import { usePagination } from "vue-request";
import { useCustomers } from "@/composables/useCustomers";
const {
  customers,
  pagination,
  stats,
  search,
  filters,
  fetchCustomers,
  fetchLoanStat,
  setPage,
  isLoading,
} = useCustomers();
import axios from "axios";

const columns = [
  {
    title: "Name",
    dataIndex: "name",
    sorter: true,
  },
  {
    title: "Email",
    dataIndex: "email",
  },
  {
    title: "Phone Number",
    dataIndex: "phone_number",
  },
  {
    title: "Savings Balance",
    dataIndex: "savings_balance",
  },
  {
    title: "Wallet Balance",
    dataIndex: "wallet_balance",
  },
  {
    title: "Cashback Balance",
    dataIndex: "interest_balance",
  },
];

const dataSource = ref([]);
const loading = ref(false);
const current = ref(1);
const pageSize = ref(10); // Assuming default page size is 10, adjust as needed

// Initially fetch records
fetchCustomers();

const handleTableChange = (pag, filters, sorter) => {
  current.value = pag.current;
  setPage(current.value);
  fetchCustomers();
};
</script>

<template>
  <AppLayout>
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Customers"
        sub-title="List of customers"
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
      :data-source="customers"
      :pagination="pagination"
      :loading="isLoading"
      @change="handleTableChange"
    >
      <template #bodyCell="{ column, text, record}">
        <template v-if="column.dataIndex === 'name'">
          <router-link :to="'/customers/' + record?.id">{{ text }}</router-link>
        </template>
      </template>
    </a-table>
  </AppLayout>
</template>

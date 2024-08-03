<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import Pagination from "@/components/pagination/index.vue";
import PageHeader from "@/components/MainContainerHeaderV2.vue";
import ExportLoanModal from "@/pages/loan/ExportModal.vue";
import DataTable from "@/components/table/index.vue";
import EmptyTable from "@/components/table/empty.vue";
import { ref, onMounted, computed } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();;
import { useLoans } from "@/composables/useLoans";
import { can } from "@/utils/permissions";
import columns from "@/columns/loans";
import { initFlowbite } from "flowbite";
const {
    loans,
    stats,
    pagination,
    search,
    filters,
    fetchLoans,
    fetchLoanStat,
    setPage,
    isLoading
} = useLoans();
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
    fetchLoans();
}

const dateValue = ref([]);
const formatter = ref({
  date: "DD MMM YYYY",
  month: "MMM",
});

const handleFilter = async () => {
  isFilter.value = true;
  setPage(1);
  await fetchLoans();
  filters.value = {
    date_range: []
  }
};
if (authStore.userType == 'admin') {
  columns.splice(1, 0, {
    title: "BUSINESS NAME",
    dataIndex: "business_name", // accessing nested data
    key: "business_name",
    sort: true,
    width: "200",
  });
}
onMounted(() => {
  initFlowbite()
  fetchLoans()
  fetchLoanStat()
});

const handleActiveTab = async (item) => {
  isFilter.value = true;
  activeTabKey.value = item;
  filters.value = {
    status: item,
  };
  await fetchLoans();
};

function handlePageChange(page) {
  setPage(page);
  fetchEmployees();
}
</script>

<template>
  <AppLayout>
    <div>
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a
              href="#"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-400 dark:text-gray-400 dark:hover:text-white"
            >
              Loans
            </a>
          </li>
        </ol>
      </nav>
    </div>
    <PageHeader
      page="Loans"
      pageBtnAction="Book a loan"
      :handleBtn="handleBookLoanBtn"
      :hasBtn="can('book_loan')"
      btnType="action"
      :tabs="stats.statuses"
      :statuses = "['all','paid', 'running','awaiting disbursement', 'approved', 'rejected']"
      :activeTabKey="activeTabKey"
      :handleActiveTab="handleActiveTab"
    />
    <div class="border bg-white border-solid rounded-lg dark:border-gray-700">
      <div v-if="loans?.length > 0 || isFilter">
        <DataTable
          :columns="columns"
          :dataSource="loans"
          :handleSearch="handleSearch"
          :handleFilter="handleFilter"
          :showSearch="true"
          :showFilter="true"
        >
          <!-- Custom action title slot -->
          <template #actionTitle=""></template>
          <!-- Custom actions slot -->
          <template #actions="{ item }">
            <router-link v-if="isAdmin" :to="'/admin/loans/details/' + item.id"
              >View</router-link
            >
            <router-link v-else :to="'/loans/details/' + item.id"
              >View</router-link
            >
          </template>

          <template #filter>
            <form class="mb-6">
              <div class="mb-[16px]">
                <label
                  for="dateRange"
                  class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                  >Date Range</label
                >
                <VueTailwindDatepicker
                  :formatter="formatter"
                  v-model="filters.date_range"
                  input-classes="input-field p-[12px]"
                  as-single
                  use-range
                />
              </div>
              <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
                <button
                  data-drawer-hide="filter-drawer-right"
                  aria-controls="filter-drawer-right"
                  type="submit"
                  class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
                >
                Cancel
                </button>
                <button
                  data-drawer-hide="filter-drawer-right"
                  type="button"
                  @click="handleFilter"
                  class="text-[#FFFFFF] bg-[#00ace2] hover:bg-[#00ace2] focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-[#F2F4F7] dark:hover:bg-[#F2F4F7] focus:outline-none dark:focus:ring-[#F2F4F7] block"
                >
                  Apply filters
                </button>
              </div>
            </form>
          </template>

          <template #noFilter>
                      <button   id="export-transactions-button" type="button" 
                      data-modal-target="export-transaction-modal" data-modal-toggle="export-transaction-modal"
                      class="text-[#3C819F] bg-[#FFFFFF] border border-[#9FC9DB] hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-[#9FC9DB] font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-[9FC9DB] dark:hover:bg-[9FC9DB] dark:focus:ring-green-800">
                          Export loan
                      </button>
                  </template>
        </DataTable>
        <Pagination :pagination="pagination" @pageChange="handlePageChange" />
      </div>
      <div v-else>
        <EmptyTable v-if="!isLoading">
              <template #empty-table-message-title>
                  <span>Loan requests made will appear here</span>
              </template>
              <template #empty-table-message-body>
                  <span></span>
              </template>
          </EmptyTable>
      </div>
    </div>
    <ExportLoanModal />
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import GoBack from "@/components/GoBack.vue";
import DetailAccordion from "@/components/DetailAccordion.vue";
import { ref, onMounted } from "vue";
import { Accordion } from "flowbite";
import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
import { can } from "@/utils/permissions";
const props = defineProps({
  id: String,
});
import { useCustomers } from "@/composables/useCustomers";
const { customer, fetchCustomer, isLoading } = useCustomers();
import { useTransactions } from "@/composables/useTransactions";
import api from "@/api";
const {
  transactions,
  stats,
  sumStats,
  pagination,
  search,
  filters,
  fetchTransactions,
  fetchTransactionStat,
  fetchTransactionSumStat,
  setPage,
} = useTransactions();

filters.value = {
  user_id: props.id,
};
fetchTransactions();

import { initFlowbite } from "flowbite";
const actionWord = ref("");
const employmentDetailsActive = ref(false);

import trxColumns from "@/columns/transaction";

onMounted(() => {
  initFlowbite();
  const accordionItem = document.getElementById("accordion-example");
  const accordionItems = [
    {
      id: "accordion-example-heading-1",
      triggerEl: document.querySelector("#accordion-example-heading-1"),
      targetEl: document.querySelector("#accordion-example-body-1"),
      active: true,
    },
  ];

  // options with default values
  const options = {
    alwaysOpen: true,
    activeClasses: "bg-white",
    onOpen: (item) => {
      employmentDetailsActive.value = false;
    },
    onClose: (item) => {
      employmentDetailsActive.value = true;
    },
    onToggle: (item) => {},
  };

  if (document.querySelector("#accordion-example-heading-1")) {
    const accordion = new Accordion(accordionItem, accordionItems, options);
    // open accordion item based on id
    accordion.open("accordion-example-heading-1");
  }
  fetchCustomer(props.id);
});

const menu = ref();
const items = ref([]);
if (can("approve_loan") && customer.value.created_by != authStore.user.id) {
  items.value.push({
    label: "Approve",
    command: () => {
      actionWord.value = "Approve";
      document.getElementById("approve-loan").click();
    },
  });
}
if (can("approve_loan") && customer.value.created_by != authStore.user.id) {
  items.value.push({
    label: "Reject",
    command: () => {
      actionWord.value = "Decline";
      document.getElementById("reject-loan").click();
    },
  });
}
const activeKey = ref("1");
const toggle = (event) => {
  menu.value.toggle(event);
};

const breadcrumb = [
  {
    path: "index",
    breadcrumbName: "First-level Menu",
  },
  {
    path: "first",
    breadcrumbName: "Second-level Menu",
  },
  {
    path: "second",
    breadcrumbName: "Third-level Menu",
  },
];
</script>

<template>
  <AppLayout>
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Customer Details"
        sub-title=""
        :breadcrumb="{ breadcrumb }"
        @back="() => $router.go(-1)"
      >
        <template #extra>
          <!-- <a-button key="1" type="primary">Primary</a-button> -->
        </template>
      </a-page-header>
    </template>
    <DetailAccordion title="Basic Information" class="mt-5">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs text-[#667085] font-normal mb-2">NAME</p>
            <p class="text-sm text-[#101828] font-normal">
              {{ customer?.name }}
            </p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal mb-2">Phone Number</p>
            <p class="text-sm text-[#101828] font-normal">
              {{ customer?.phone_number }}
            </p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal mb-2">Email Address</p>
            <p class="text-sm text-[#101828] font-normal">
              {{ customer?.email }}
            </p>
          </div>
          <div class="w-20"></div>
        </div>
      </div>
    </DetailAccordion>
    <div class="mt-5 p-5 border rounded-xl border-gray-200 min-h-[450px]">
      <a-tabs v-model:activeKey="activeKey">
        <a-tab-pane key="1" tab="Savings"> 
          <a-table
            :columns="trxColumns"
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
                <a-tag color="success" v-if="text == 'CREDIT'">{{ text }}</a-tag>
                <a-tag color="red" v-if="text == 'DEBIT'">{{ text }}</a-tag>
              </template>
              <template v-if="column.dataIndex === 'type'"
                >-
                <a-tag color="processing">{{ record.group }}</a-tag>
              </template>
              <template v-if="column.dataIndex === 'status'">
                <a-tag color="warning" v-if="text == 'pending'">{{ text }}</a-tag>
                <a-tag color="success" v-if="text == 'successful'">{{ text }}</a-tag>
              </template>
              <template v-if="column.dataIndex === 'status'"
                >-
                <a-tag color="processing">{{ record.category }}</a-tag>
              </template>
            </template>
          </a-table>
        </a-tab-pane>
        <a-tab-pane key="2" tab="Transactions" force-render>
          <a-table
            :columns="trxColumns"
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
                <a-tag color="success" v-if="text == 'CREDIT'">{{ text }}</a-tag>
                <a-tag color="red" v-if="text == 'DEBIT'">{{ text }}</a-tag>
              </template>
              <template v-if="column.dataIndex === 'type'"
                >-
                <a-tag color="processing">{{ record.group }}</a-tag>
              </template>
              <template v-if="column.dataIndex === 'status'">
                <a-tag color="warning" v-if="text == 'pending'">{{ text }}</a-tag>
                <a-tag color="success" v-if="text == 'successful'">{{ text }}</a-tag>
              </template>
              <template v-if="column.dataIndex === 'status'"
                >-
                <a-tag color="processing">{{ record.category }}</a-tag>
              </template>
            </template>
          </a-table>
        </a-tab-pane>
      </a-tabs>
    </div>
  </AppLayout>
</template>

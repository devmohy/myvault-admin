<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import GoBack from "@/components/GoBack.vue";
import DetailAccordion from "@/components/DetailAccordion.vue";
import EmployeeDetails from "@/pages/transaction/tabs/EmployeeDetails.vue";
import PayrollDetails from "@/pages/transaction/tabs/PayrollDetails.vue";
import LoanDetails from "@/pages/transaction/tabs/LoanDetails.vue";
import { initFlowbite } from "flowbite";
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useTransactions } from "@/composables/useTransactions";
const {
    transactions,
    transaction,
    fetchTransactionDetails,
    setPage,
    isLoading
} = useTransactions();

const actionWord = ref("");
const authStore = useAuthStore();

const props = defineProps({
    id: String,
})

async function initData() {
  await fetchTransactionDetails(props.id);
  initFlowbite();
}

onMounted(() => {
  initFlowbite();
  initData();
});


</script>

<template>
  <AppLayout :isLoading="isLoading">
    <div>
      <nav class="md:flex hidden" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a
              href="/transactions"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-400 dark:text-gray-400 dark:hover:text-white"
            >
              Transaction
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg
                class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 6 10"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 9 4-4-4-4"
                />
              </svg>
              <a
                href="#"
                class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-400 md:ms-2 text-ellipsis overflow-hidden ..."
              >
                {{ transaction.reference }}
              </a>
            </div>
          </li>
        </ol>
      </nav>
      <div class="block md:hidden">
        <GoBack />
      </div>
    </div>
    <div
      class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 pt-8 bg dark:bg-gray-900"
    >
      <div class="flex flex-row gap-2">
        <div class="">
          <p
            class="text-2xl text-[#101828] font-semibold whitespace-normal break-all"
          >
          {{ transaction.reference }}
          </p>
        </div>
      </div>
      <!-- <div class="flex gap-1">
        <button
          id="dropdownMoreButton"
          data-dropdown-toggle="dropdown"
          type="button"
          class="text-white bg-[#4F9CBD] hover:bg-[#4F9CBD] border focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 inline-flex text-center me-2 mb-2"
        >
          Actions
          <svg
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.66666 8.33398L9.99999 11.6673L13.3333 8.33398"
              stroke="white"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
        <div id="dropdown" class="z-10 hidden bg-white rounded-lg shadow w-44">
          <ul class="p-2 text-sm text-gray-700" aria-labelledby="dropdownMoreButton">
            <li>
              <a
                data-modal-target="approve-decline-modal"
                data-modal-toggle="approve-decline-modal"
                @click="actionWord = 'Approve'"
                href="#"
                class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                >Approve</a
              >
            </li>
            <li>
              <a
                data-modal-target="approve-decline-modal"
                data-modal-toggle="approve-decline-modal"
                @click="actionWord = 'Decline'"
                href="#"
                class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                >Decline</a
              >
            </li>
          </ul>
        </div>
      </div> -->
    </div>
    <DetailAccordion title="Transaction details">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">Transaction ID</p>
            <div style="overflow-wrap: break-word">
              <p class="text-sm text-[#101828] font-normal">
                {{ transaction.id }}
              </p>
            </div>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">TYPE</p>
            <p class="text-sm text-[#101828]">{{ transaction.type }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">PAYROLL NAME</p>
            <p class="text-sm text-[#101828]">{{ transaction.payroll_name }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">CYCLE STARTS</p>
            <p class="text-sm text-[#101828]">{{ transaction.cycle_starts }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">Amount</p>
            <p class="text-sm text-[#101828]">₦ {{ transaction.amount }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">narration</p>
            <p class="text-sm text-[#101828]">{{ transaction.narration }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">status</p>
            <StatusBadge :status="transaction.status" />
          </div>
          <div>
            <p class="text-sm mb-2 text-[#667085] font-normal">DATE</p>
            <p class="text-sm text-[#101828]">{{ transaction.date }}</p>
          </div>
        </div>
      </div>
    </DetailAccordion>

    <div v-if="authStore.userType === 'admin'">
    <DetailAccordion title="Business Details">
        <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
          <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
              <div>
                  <p class="text-xs text-[#667085] font-normal mb-2">NAME</p>
                  <p class="text-sm text-[#101828] font-normal">{{ transaction.business_name }}</p>
              </div>
              <div>
                  <p class="text-xs text-[#667085] font-normal mb-2">RC NUMBER</p>
                  <p class="text-sm text-[#101828] font-normal">{{ transaction.rc_number  }}</p>
              </div>
              <div>
                  <p class="text-xs text-[#667085] font-normal mb-2">BUSINESS TYPE</p>
                  <p class="text-sm text-[#101828] font-normal">{{ transaction.business_type }}</p>
              </div>
              <div class="w-20">
                  
              </div>
          </div>
        </div>
    </DetailAccordion>
    </div>

    <div
      class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-4 mt-5"
    >
      <ul
        class="flex overflow-x-auto -mb-px"
        id="default-tab"
        data-tabs-toggle="#default-tab-content"
        role="tablist"
      >
        <li class="me-2">
          <a
          class="inline-block border-b-2 rounded-t-lg aria-selected:bg-[#F8FBFC]  hover:bg-[#F8FBFC] aria-selected:border-[#4F9CBD] aria-selected:text-[#2E637A]"
            id="employee-tab"
            data-tabs-target="#employee"
            type="button"
            role="tab"
            aria-controls="employee"
            aria-selected="false"
          >
            <div
              class="inline-flex items-center p-[12px] text-sm text-center text-[#2E637A]"
            >
              <span class="text-sm whitespace-nowrap">Employee details</span>
            </div>
          </a>
        </li>
        <!-- <li class="me-2">
          <a
            class="inline-block border-b-2 rounded-t-lg aria-selected:bg-[#F8FBFC]  hover:bg-[#F8FBFC] aria-selected:border-[#4F9CBD] aria-selected:text-[#2E637A]"
            id="payroll-tab"
            data-tabs-target="#payroll"
            type="button"
            role="tab"
            aria-controls="payroll"
            aria-selected="false"
          >
            <div
              class="inline-flex items-center p-[12px] text-sm text-center text-[#2E637A]"
            >
              <span class="text-sm whitespace-nowrap">Payroll details</span>
            </div>
          </a>
        </li> -->
        <!-- <li class="me-2" v-show="transactionDetails.loan_details">
          <a
            class="inline-block border-b-2 rounded-t-lg aria-selected:bg-[#F8FBFC]  hover:bg-[#F8FBFC] aria-selected:border-[#4F9CBD] aria-selected:text-[#2E637A]"
            id="loan-tab"
            data-tabs-target="#loan"
            type="button"
            role="tab"
            aria-controls="loan"
            aria-selected="false"
          >
            <div
              class="inline-flex items-center p-[12px] text-sm text-center text-[#2E637A]"
            >
              <span class="text-sm whitespace-nowrap">Loan details</span>
            </div>
          </a>
        </li> -->
      </ul>
    </div>

    <div id="default-tab-content">
      <EmployeeDetails :employeeDetails="transaction.employee_details" />
      <!-- <PayrollDetails :payrollDetails="transactionDetails ? transactionDetails.payroll_details : ''"  /> -->
      <!-- <LoanDetails /> -->
    </div>

  </AppLayout>
</template>

<style scoped></style>

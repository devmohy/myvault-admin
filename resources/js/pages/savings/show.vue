<script setup>
import BusinessLayout from "@/layout/AppLayout.vue";
import GoBack from "@/components/GoBack.vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import DetailAccordion from "@/components/DetailAccordion.vue";
import Button from "primevue/button";
import TieredMenu from "primevue/tieredmenu";
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
import { useLoans } from "@/composables/useLoans";
const { loan, fetchLoan, isLoading } = useLoans();
import { initFlowbite } from "flowbite";
const actionWord = ref("");
const employmentDetailsActive = ref(false);
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
  fetchLoan(props.id);
});

const menu = ref();
const items = ref([]);
console.log(loan.created_by);
if (can("approve_loan") && loan.value.created_by != authStore.user.id) {
  items.value.push({
    label: "Approve",
    command: () => {
      actionWord.value = "Approve";
      document.getElementById("approve-loan").click();
    },
  });
}
if (can("approve_loan") && loan.value.created_by != authStore.user.id) {
  items.value.push({
    label: "Reject",
    command: () => {
      actionWord.value = "Decline";
      document.getElementById("reject-loan").click();
    },
  });
}

const toggle = (event) => {
  menu.value.toggle(event);
};
</script>

<template>
  <BusinessLayout>
    <div>
      <nav class="md:flex hidden" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <router-link
              v-if="isAdmin"
              to="/admin/loans"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-400 dark:text-gray-400 dark:hover:text-white"
            >
              Loans
            </router-link>
            <router-link
              v-else
              to="/loans"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-400 dark:text-gray-400 dark:hover:text-white"
            >
              Loans
            </router-link>
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
                class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-400 md:ms-2 dark:text-gray-400 dark:hover:text-white"
              >
                {{ loan.reference }}
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
          <p class="text-2xl text-[#101828] font-semibold">{{ loan.reference }}</p>
        </div>
      </div>
      <div class="flex gap-1">
        <Button
          v-if="
            (loan.status === 'pending' &&
              !isAdmin &&
              can('approve_loan') &&
              loan.created_by !== authStore.user.id) ||
            (loan.business?.owner_id === authStore.user.id && loan.status === 'pending')
          "
          type="button"
          class="text-white bg-[#00ace2] hover:bg-[#00ace2] border focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 inline-flex text-center me-2 mb-2"
          rounded
          label="Actions"
          @click="toggle"
          aria-haspopup="true"
          aria-controls="overlay_tmenu"
          icon="pi pi-angle-down"
          iconPos="right"
        />
        <TieredMenu
          ref="menu"
          id="overlay_tmenu"
          class="bg-white"
          :model="items"
          popup
          v-if="
          (loan.status === 'pending' &&
              !isAdmin &&
              can('approve_loan') &&
              loan.created_by !== authStore.user.id) ||
            (loan.business?.owner_id === authStore.user.id && loan.status === 'pending')
          "
        />
        <div id="dropdown" class="z-10 hidden bg-white rounded-lg shadow w-44">
          <ul class="p-2 text-sm text-gray-700" aria-labelledby="dropdownMoreButton">
            <li>
              <a
                id="approve-loan"
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
                id="reject-loan"
                data-modal-target="approve-decline-modal"
                data-modal-toggle="approve-decline-modal"
                @click="actionWord = 'Decline'"
                href="#"
                class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                >Reject</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <DetailAccordion title="Loan details">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">Loan ID</p>
            <p class="text-sm text-[#101828] font-normal">{{ loan.reference }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">LOAN TYPE</p>
            <p class="text-sm text-[#101828]">{{ loan?.loan_type?.name }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">loan amount</p>
            <p class="text-sm text-[#101828]">{{ loan.amount }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">tenor</p>
            <p class="text-sm text-[#101828]">{{ loan.tenor }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">reason</p>
            <p class="text-sm text-[#101828]">{{ loan.reason }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">status</p>
            <StatusBadge :status="loan.status" />
          </div>
          <div>
            <p class="text-sm text-[#667085] font-normal">AMOUNT PAID</p>
            <p class="text-sm text-[#101828]">{{ loan.amount_paid }}</p>
          </div>
          <div>
            <p class="text-sm text-[#667085] font-normal">AMOUNT OUTSTANDING</p>
            <p class="text-sm text-[#101828]">{{ loan.amount_paid }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">Next payment date</p>
            <p class="text-sm text-[#101828]">{{ "NIL" }}</p>
          </div>
        </div>
      </div>
    </DetailAccordion>
    <DetailAccordion title="Business Details" class="mt-5" v-if="isAdmin">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs text-[#667085] font-normal mb-2">NAME</p>
            <p class="text-sm text-[#101828] font-normal">
              {{ loan.business ? loan.business.business_name : "" }}
            </p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal mb-2">RC NUMBER</p>
            <p class="text-sm text-[#101828] font-normal">
              {{ loan.business ? loan.business.rc_number : "" }}
            </p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal mb-2">BUSINESS TYPE</p>
            <p class="text-sm text-[#101828] font-normal">
              {{ loan.business ? loan.business.business_type : "" }}
            </p>
          </div>
          <div class="w-20"></div>
        </div>
      </div>
    </DetailAccordion>
    <div
      class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-4 mt-5"
    >
      <ul class="flex flex-wrap -mb-px">
        <li class="me-2">
          <a
            href="#"
            class="inline-block border-b-2 border-[#00ace2] rounded-t-lg active dark:border-gray-200"
            aria-current="page"
          >
            <div
              class="inline-flex items-center px-5 py-2.5 text-sm text-center text-[#2E637A] bg-[#F8FBFC] hover:bg-gray-200"
            >
              <span class="text-sm">Employee details</span>
            </div>
          </a>
        </li>
      </ul>
    </div>

    <DetailAccordion title="Employee details">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">name</p>
            <p class="text-sm text-[#101828]">{{ loan?.employee?.name }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">email address</p>
            <p class="text-sm text-[#101828]">{{ loan?.employee?.email_address }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">phone number</p>
            <p class="text-sm text-[#101828]">{{ loan?.employee?.phone_number }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">employment date</p>
            <p class="text-sm text-[#101828]">{{ loan?.employee?.employement_date }}</p>
          </div>

          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">job title</p>
            <p class="text-sm text-[#101828]">{{ loan?.employee?.job_title }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">current salary</p>
            <p class="text-sm text-[#101828]">{{ loan?.employee?.annual_net_salary }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">bank name</p>
            <p class="text-sm text-[#101828]">
              {{ loan?.employee?.bankDetails?.bank_name ?? "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">account number</p>
            <p class="text-sm text-[#101828]">
              {{ loan?.employee?.bankDetails?.account_number ?? "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">account name</p>
            <p class="text-sm text-[#101828]">
              {{ loan?.employee?.bankDetails?.account_name ?? "N/A" }}
            </p>
          </div>
        </div>
      </div>
    </DetailAccordion>
  </BusinessLayout>
</template>

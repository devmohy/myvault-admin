<script setup>
import InputField from "@/components/InputField.vue";
import { ref, onMounted, computed } from "vue";
import DashboardIcon from "@/components/images/icons/DashboardIcon.vue";
import EmployeeIcon from "@/components/images/icons/EmployeeIcon.vue";
import ArrowDown from "@/components/images/ArrowDown.vue";
import PayrollIcon from "@/components/images/icons/PayrollIcon.vue";
import LoansIcon from "@/components/images/icons/LoansIcon.vue";
import TransactionIcon from "@/components/images/icons/TransactionIcon.vue";
import RolesIcon from "@/components/images/icons/RolesIcon.vue";
import AuditTrailIcon from "@/components/images/icons/AuditTrailIcon.vue";
import SettingsIcon from "@/components/images/icons/SettingsIcon.vue";

onMounted(() => {
  // new Modal('#approve-decline-modal');
});
</script>

<template>
  <div
    id="create-role-drawer-right"
    class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-2/6 dark:bg-gray-800"
    tabindex="-1"
    aria-labelledby="drawer-right-label"
  >
    <h5
      id="drawer-right-label"
      class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"
    >
      Create role
    </h5>
    <button
      type="button"
      data-drawer-hide="create-role-drawer-right"
      aria-controls="create-role-drawer-right"
      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
    >
      <svg
        class="w-3 h-3"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 14 14"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
        />
      </svg>
      <span class="sr-only">Close menu</span>
    </button>
    <div class="mb-6">
      <span class="text-base text-[#101828]">Basic information</span>
    </div>

    <form class="mb-6 max-h-[80vh] overflow-y-auto">
      <InputField id="role_name" label="Role name" type="text" placeholder="Role name" />
      <InputField
        id="description"
        label="Description"
        type="text"
        placeholder="Enter description"
      />

      <div class="my-4 p-4 bg-[#F9FAFB]">
        <div>
          <p class="text text-sm text-[#101828]">Permissions</p>
        </div>
        <div class="flex justify-between my-8">
          <div class="flex item-center">
            <DashboardIcon />
            <p class="mx-2 text-sm text-[#101828]">Dashboard</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer" />
            <div
              class="w-11 h-6 bg-[#F2F4F7] rounded-full peer peer-focus:ring-[#00ace2] dark:peer-focus:ring-[#00ace2] dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#00ace2]"
            ></div>
          </label>
        </div>
        <div class="flex justify-between my-8">
          <div class="w-full" id="accordion-collapse" data-accordion="collapse">
            <h2 id="accordion-collapse-heading-1">
              <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3"
                data-accordion-target="#accordion-collapse-body-1"
                aria-expanded="true"
                aria-controls="accordion-collapse-body-1"
              >
                <div class="flex p-0 m-0">
                  <EmployeeIcon />
                  <span class="mx-2 text-sm text-[#101828]">Employees</span>
                </div>
                <div class="flex item-center flex-row">
                  <p class="pr-2 text-xs">5 Permissions</p>
                  <ArrowDown />
                </div>
              </button>
            </h2>
            <div
              id="accordion-collapse-body-1"
              class="hidden"
              aria-labelledby="accordion-collapse-heading-1"
            >
              <ul class="w-full text-sm font-normal text-[#475467]">
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="ve-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-[#475467]"
                      >View employees</label
                    >
                    <input
                      id="ve-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#00ace2] dark:focus:ring-[#00ace2] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="ce-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Create employees</label
                    >
                    <input
                      id="ce-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="ue-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Update employees</label
                    >
                    <input
                      id="ue-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="ae-de-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Activate/Deactivate employees</label
                    >
                    <input
                      id="ae-de-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="de-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Delete employees</label
                    >
                    <input
                      id="de-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
              </ul>
            </div>
            <h2 id="accordion-collapse-heading-2">
              <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3"
                data-accordion-target="#accordion-collapse-body-2"
                aria-expanded="true"
                aria-controls="accordion-collapse-body-2"
              >
                <div class="flex p-0 m-0">
                  <PayrollIcon />
                  <span class="mx-2 text-sm text-[#101828]">Payroll</span>
                </div>
                <div class="flex item-center flex-row">
                  <p class="pr-2 text-xs">4 Permissions</p>
                  <svg
                    data-accordion-icon
                    class="w-3 h-3 rotate-180 shrink-0 mt-0.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 10 6"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5 5 1 1 5"
                    />
                  </svg>
                </div>
              </button>
            </h2>
            <div
              id="accordion-collapse-body-2"
              class="hidden"
              aria-labelledby="accordion-collapse-heading-2"
            >
              <ul class="w-full text-sm font-normal text-[#475467]">
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="vp-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-[#475467]"
                      >View payroll</label
                    >
                    <input
                      id="vp-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#00ace2] dark:focus:ring-[#00ace2] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="cp-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Create payroll</label
                    >
                    <input
                      id="cp-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="up-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Update payroll</label
                    >
                    <input
                      id="up-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="de-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Delete payroll</label
                    >
                    <input
                      id="de-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
              </ul>
            </div>
            <h2 id="accordion-collapse-heading-4">
              <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3"
                data-accordion-target="#accordion-collapse-body-4"
                aria-expanded="true"
                aria-controls="accordion-collapse-body-4"
              >
                <div class="flex p-0 m-0">
                  <LoansIcon />
                  <span class="mx-2 text-sm text-[#101828]">Loans</span>
                </div>
                <div class="flex item-center flex-row">
                  <p class="pr-2 text-xs">3 Permissions</p>
                  <svg
                    data-accordion-icon
                    class="w-3 h-3 rotate-180 shrink-0 mt-0.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 10 6"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5 5 1 1 5"
                    />
                  </svg>
                </div>
              </button>
            </h2>
            <div
              id="accordion-collapse-body-4"
              class="hidden"
              aria-labelledby="accordion-collapse-heading-4"
            >
              <ul class="w-full text-sm font-normal text-[#475467]">
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="vl-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-[#475467]"
                      >View loan</label
                    >
                    <input
                      id="vl-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#00ace2] dark:focus:ring-[#00ace2] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="cl-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Create loan</label
                    >
                    <input
                      id="cl-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="ul-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Update loan</label
                    >
                    <input
                      id="ul-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
              </ul>
            </div>
            <h2 id="accordion-collapse-heading-3">
              <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3"
                data-accordion-target="#accordion-collapse-body-3"
                aria-expanded="true"
                aria-controls="accordion-collapse-body-3"
              >
                <div class="flex p-0 m-0">
                  <TransactionIcon />
                  <span class="mx-2 text-sm text-[#101828]">Transactions</span>
                </div>
                <div class="flex item-center flex-row">
                  <p class="pr-2 text-xs">2 Permissions</p>
                  <svg
                    data-accordion-icon
                    class="w-3 h-3 rotate-180 shrink-0 mt-0.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 10 6"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5 5 1 1 5"
                    />
                  </svg>
                </div>
              </button>
            </h2>
            <div
              id="accordion-collapse-body-3"
              class="hidden"
              aria-labelledby="accordion-collapse-heading-3"
            >
              <ul class="w-full text-sm font-normal text-[#475467]">
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="vt-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-[#475467]"
                      >View transaction</label
                    >
                    <input
                      id="vt-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#00ace2] dark:focus:ring-[#00ace2] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="ct-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Create transaction</label
                    >
                    <input
                      id="ct-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
              </ul>
            </div>
            <h2 id="accordion-collapse-heading-5">
              <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3"
                data-accordion-target="#accordion-collapse-body-5"
                aria-expanded="true"
                aria-controls="accordion-collapse-body-5"
              >
                <div class="flex p-0 m-0">
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M17.327 7.93127C17.9854 8.58963 17.9854 9.65704 17.327 10.3154C16.6686 10.9738 15.6012 10.9738 14.9429 10.3154C14.2845 9.65704 14.2845 8.58963 14.9429 7.93127C15.6012 7.27291 16.6686 7.27291 17.327 7.93127"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M11.8354 4.92436C12.8492 5.9381 12.8492 7.58169 11.8354 8.59543C10.8217 9.60916 9.17809 9.60916 8.16435 8.59543C7.15062 7.5817 7.15062 5.9381 8.16435 4.92436C9.17809 3.91063 10.8217 3.91063 11.8354 4.92436"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M5.05697 7.93127C5.71533 8.58963 5.71533 9.65704 5.05697 10.3154C4.39861 10.9738 3.3312 10.9738 2.67285 10.3154C2.01449 9.65704 2.01449 8.58963 2.67285 7.93127C3.33121 7.27291 4.39861 7.27291 5.05697 7.93127"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M19.1666 15.8287V14.9154C19.1666 13.7645 18.2341 12.832 17.0833 12.832H16.4158"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M0.833252 15.8287V14.9154C0.833252 13.7645 1.76575 12.832 2.91659 12.832H3.58409"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M14.4491 15.829V14.4948C14.4491 12.884 13.1433 11.5781 11.5324 11.5781H8.46659C6.85576 11.5781 5.54993 12.884 5.54993 14.4948V15.829"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  <span class="mx-2 text-sm text-[#101828]">Team members</span>
                </div>
                <div class="flex item-center flex-row">
                  <p class="pr-2 text-xs">3 Permissions</p>
                  <TeamIcon />
                </div>
              </button>
            </h2>
            <div
              id="accordion-collapse-body-5"
              class="hidden"
              aria-labelledby="accordion-collapse-heading-5"
            >
              <ul class="w-full text-sm font-normal text-[#475467]">
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="vm-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-[#475467]"
                      >View members</label
                    >
                    <input
                      id="vm-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#00ace2] dark:focus:ring-[#00ace2] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="cm-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Create members</label
                    >
                    <input
                      id="cm-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
                <li class="w-full">
                  <div class="flex items-center ps-3">
                    <label
                      for="um-checkbox"
                      class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >Update members</label
                    >
                    <input
                      id="um-checkbox"
                      type="checkbox"
                      value=""
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-[#475467] dark:focus:ring-[#475467] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                  </div>
                </li>
              </ul>
            </div>
            <h2 id="accordion-collapse-heading-6">
              <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3"
                data-accordion-target="#accordion-collapse-body-6"
                aria-expanded="true"
                aria-controls="accordion-collapse-body-6"
              >
                <div class="flex p-0 m-0">
                  <RolesIcon />
                  <span class="mx-2 text-sm text-[#101828]">Roles</span>
                </div>
                <div class="flex item-center flex-row">
                  <p class="pr-2 text-xs">No Permissions</p>
                  <svg
                    data-accordion-icon
                    class="w-3 h-3 rotate-180 shrink-0 mt-0.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 10 6"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5 5 1 1 5"
                    />
                  </svg>
                </div>
              </button>
            </h2>
            <div
              id="accordion-collapse-body-6"
              class="hidden"
              aria-labelledby="accordion-collapse-heading-6"
            >
              <ul class="w-full text-sm font-normal text-[#475467]"></ul>
            </div>
          </div>
        </div>
      </div>

      <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
        <button
          data-drawer-hide="create-role-drawer-right"
          aria-controls="create-role-drawer-right"
          type="submit"
          class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="text-[#FFFFFF] bg-[#00ace2] hover:bg-[#00ace2] focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-[#F2F4F7] dark:hover:bg-[#F2F4F7] focus:outline-none dark:focus:ring-[#F2F4F7] block"
        >
          Save role
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import InputField from "@/components/InputField.vue";
import SelectField from "@/components/SelectField.vue";
import GoBack from "@/components/GoBack.vue";
import { ref, onMounted, computed } from "vue";


onMounted(() => {});
</script>

<template>
  <div
    id="edit-role-drawer-right"
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
      data-drawer-hide="edit-role-drawer-right"
      aria-controls="edit-role-drawer-right"
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
        <InputField
          id="role_name"
          label="Role name"
          type="text"
          placeholder="Role name"
        />
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
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <rect
                x="2.5"
                y="2.5"
                width="15"
                height="15"
                rx="4.16667"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M8.33333 17.5V7.5"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M17.5 7.4987H2.5"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M8.33333 12.0846H17.5"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
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
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M8.40917 6.79527C9.1414 7.5275 9.1414 8.71469 8.40917 9.44692C7.67693 10.1792 6.48975 10.1792 5.75752 9.44692C5.02528 8.71469 5.02528 7.5275 5.75752 6.79527C6.48975 6.06304 7.67693 6.06304 8.40917 6.79527"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M1.66667 15.4141V4.6149C1.66667 3.67573 2.42833 2.91406 3.3675 2.91406H16.6667C17.5875 2.91406 18.3333 3.6599 18.3333 4.58073V15.4141C18.3333 16.3349 17.5875 17.0807 16.6667 17.0807H3.33333C2.4125 17.0807 1.66667 16.3349 1.66667 15.4141Z"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M12.5 7.91276H15.8333"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M14.5 11.2487H12.5"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M10.0792 13.7487C9.93333 13.3829 9.70833 13.0545 9.41917 12.787V12.787C8.93 12.3337 8.28833 12.082 7.62167 12.082H6.545C5.87833 12.082 5.23667 12.3337 4.7475 12.787V12.787C4.45833 13.0545 4.23333 13.3829 4.0875 13.7487"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  <span class="mx-2 text-sm text-[#101828]">Employees</span>
                </div>
                <div class="flex item-center flex-row">
                  <p class="pr-2 text-xs">5 Permissions</p>
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
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M3.7474 3.32812H13.3347C14.2556 3.32812 15.0021 4.07463 15.0021 4.99549V13.3323"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M7.49896 6.67856H12.501"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M7.49896 9.99887H12.501"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M6.24844 16.667H15.8358C16.7566 16.667 17.5031 15.9205 17.5031 14.9997V14.166C17.5031 13.7055 17.1299 13.3323 16.6694 13.3323H8.33264C7.87221 13.3323 7.49896 13.7055 7.49896 14.166V15.4165C7.49896 16.1071 6.93908 16.667 6.24844 16.667V16.667C5.55779 16.667 4.99792 16.1071 4.99792 15.4165V4.57865C4.99792 3.888 4.43804 3.32812 3.7474 3.32812V3.32812C3.05675 3.32812 2.49688 3.888 2.49688 4.57865V6.66285C2.49688 7.12328 2.87013 7.49653 3.33056 7.49653H4.99792"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
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
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect
                      x="4.16668"
                      y="5"
                      width="8.33333"
                      height="2.5"
                      rx="0.833333"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M5.06843 7.5L2.90387 9.97376C1.56693 11.5017 1.28667 13.6864 2.19463 15.5023L2.27213 15.6573C2.83676 16.7866 3.99098 17.5 5.25357 17.5H11.663"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M13.8747 10.0103L11.5552 7.5"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M5.34047 5L4.67732 3.71566C4.54394 3.45732 4.55483 3.14814 4.70607 2.89983C4.85732 2.65153 5.12704 2.5 5.41778 2.5H11.2489C11.5396 2.5 11.8093 2.65152 11.9606 2.89982C12.1118 3.14812 12.1227 3.4573 11.9893 3.71563L11.3262 5"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.3333 14.1667C18.3297 16.4629 16.4662 18.3218 14.17 18.32C11.8738 18.3182 10.0133 16.4562 10.0133 14.16C10.0133 11.8638 11.8738 10.0018 14.17 10C16.4662 9.99816 18.3297 11.8571 18.3333 14.1533V14.1667Z"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M12.917 15.418L15.417 12.918"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M15.625 15.542C15.6248 15.5879 15.5875 15.6251 15.5415 15.625C15.4955 15.6249 15.4583 15.5876 15.4583 15.5417C15.4583 15.4957 15.4955 15.4584 15.5415 15.4583C15.5875 15.4582 15.6248 15.4954 15.625 15.5414V15.542"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M12.7083 12.7914C12.7085 12.7454 12.7459 12.7082 12.7918 12.7083C12.8378 12.7084 12.875 12.7457 12.875 12.7917C12.875 12.8376 12.8378 12.8749 12.7918 12.875C12.7459 12.8751 12.7085 12.8379 12.7083 12.792V12.7914"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
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
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <ellipse
                      cx="7.49891"
                      cy="8.3342"
                      rx="5.00208"
                      ry="2.0842"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M12.501 11.25C12.501 12.4011 10.2615 13.3342 7.49891 13.3342C4.73633 13.3342 2.49683 12.4011 2.49683 11.25"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M17.5031 8.33203C17.5031 9.4831 15.2636 10.4162 12.501 10.4162"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M12.501 8.33203V14.5846C12.501 15.7357 10.2615 16.6688 7.49891 16.6688C4.73633 16.6688 2.49683 15.7357 2.49683 14.5846V8.33203"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M17.5031 5.41406V11.6667C17.5031 12.8177 15.2636 13.7509 12.501 13.7509"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M7.91586 6.25434C7.66837 6.0419 7.5179 5.73795 7.49902 5.41233C7.49902 4.26185 9.74162 3.32812 12.5011 3.32812C15.2606 3.32812 17.5032 4.26185 17.5032 5.41233C17.5032 6.56281 15.2606 7.49653 12.5011 7.49653C12.3594 7.49653 12.2177 7.49653 12.0843 7.48819"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
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
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M9.16667 12.5H5.83333C3.99238 12.5 2.5 13.9924 2.5 15.8333V16.6667"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <circle
                      cx="9.16671"
                      cy="5.83333"
                      r="3.33333"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M18.3333 13.75C18.3333 15.3608 17.0275 16.6667 15.4167 16.6667C15.1269 16.6626 14.8395 16.6149 14.564 16.5252"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M15.4166 10.832C17.0275 10.832 18.3333 12.1379 18.3333 13.7487"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M12.6407 14.599C12.5515 14.3242 12.5041 14.0376 12.5 13.7487C12.5 12.1379 13.8058 10.832 15.4167 10.832"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M12.6408 14.6016L11.0603 16.1845C10.9153 16.3307 10.8338 16.5281 10.8334 16.734V17.5573C10.8334 17.9866 11.1814 18.3346 11.6107 18.3346H12.4375C12.6439 18.3349 12.8418 18.2525 12.987 18.106L14.564 16.5265"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M15.4583 13.7487C15.4583 13.7717 15.4396 13.7904 15.4166 13.7904C15.3937 13.7904 15.375 13.7717 15.375 13.7487C15.375 13.7257 15.3936 13.7071 15.4166 13.707C15.4277 13.707 15.4383 13.7114 15.4461 13.7192C15.454 13.7271 15.4583 13.7377 15.4583 13.7487"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
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
        <div class="flex justify-between my-8">
          <div class="flex item-center">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M4.16419 17.5023H15.8357C16.7566 17.5023 17.5031 16.7558 17.5031 15.835V4.16345C17.5031 3.2426 16.7566 2.49609 15.8357 2.49609H7.49891C6.57805 2.49609 5.83155 3.2426 5.83155 4.16345V15.835C5.83155 16.7558 5.08505 17.5023 4.16419 17.5023V17.5023C3.24333 17.5023 2.49683 16.7558 2.49683 15.835V6.6645C2.49683 5.74364 3.24333 4.99714 4.16419 4.99714H5.83155"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M8.74951 5.8309H14.5853"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M8.74951 9.16684H14.5853"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M8.74951 12.5028H14.5853"
                stroke="#667085"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <p class="mx-2 text-sm text-[#101828]">Audit trail</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer" />
            <div
              class="w-11 h-6 bg-[#F2F4F7] rounded-full peer peer-focus:ring-[#00ace2] dark:peer-focus:ring-[#00ace2] dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#00ace2]"
            ></div>
          </label>
        </div>
        <div class="flex justify-between my-8">
          <div class="w-full" id="accordion-collapse-2" data-accordion="collapse-1">
            <h2 id="accordion-collapse-heading-7">
              <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right gap-3"
                data-accordion-target="#accordion-collapse-body-7"
                aria-expanded="true"
                aria-controls="accordion-collapse-body-7"
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
                      d="M3.7474 3.32812H13.3347C14.2556 3.32812 15.0021 4.07463 15.0021 4.99549V13.3323"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M7.49896 6.67856H12.501"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M7.49896 9.99887H12.501"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M6.24844 16.667H15.8358C16.7566 16.667 17.5031 15.9205 17.5031 14.9997V14.166C17.5031 13.7055 17.1299 13.3323 16.6694 13.3323H8.33264C7.87221 13.3323 7.49896 13.7055 7.49896 14.166V15.4165C7.49896 16.1071 6.93908 16.667 6.24844 16.667V16.667C5.55779 16.667 4.99792 16.1071 4.99792 15.4165V4.57865C4.99792 3.888 4.43804 3.32812 3.7474 3.32812V3.32812C3.05675 3.32812 2.49688 3.888 2.49688 4.57865V6.66285C2.49688 7.12328 2.87013 7.49653 3.33056 7.49653H4.99792"
                      stroke="#667085"
                      stroke-width="1.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  <span class="mx-2 text-sm text-[#101828]">Settings</span>
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
              id="accordion-collapse-body-7"
              class="hidden"
              aria-labelledby="accordion-collapse-heading-7"
            >
              <ul class="w-full text-sm font-normal text-[#475467]"></ul>
            </div>
          </div>
        </div>
      </div>

      <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
        <button
          data-drawer-hide="edit-role-drawer-right"
          aria-controls="edit-role-drawer-right"
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

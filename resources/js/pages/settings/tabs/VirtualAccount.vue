<script setup>
import { useAuthStore } from "@/stores/auth";
const user = useAuthStore().user;


function copyToClipboard() {
  let copyText = document.getElementById("settings-virtual-account").innerHTML;

  navigator.clipboard.writeText(copyText);
}

</script>
<template>
    <div
    class="hidden" id="virtual-account" role="tabpanel" aria-labelledby="virtual-account-tab">
        <div class="p-4 border text-white border-gray-200 rounded-lg shadow sm:p-8 bg-pattern bg-[#1F3946]/100">
            <div class="flex items-center justify-between mb-1">
                <h5 class="text-base">Unprocessed funds</h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="border-b">
                <li class="py-2 sm:py-3">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0">
                            <p class="text-base lg:text-3xl font-medium text-white">
                            <span class="text-2xl">NGN</span> 0.00
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold">
                            <button class="btn p-3 bg-[#FFFFFF1F] text-white" data-modal-target="withdraw-funds-modal" data-modal-toggle="withdraw-funds-modal">Withdraw</button>
                        </div>
                        <div id="withdraw-funds-modal" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-medium text-[#101828] dark:text-white">
                                            Withdraw unprocessed funds
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="withdraw-funds-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="px-4 py-2 md:px-5 py-2 space-y-4">
                                        <p class="flex text-sm  text-[#475467] dark:text-gray-400">
                                            Are you sure you want withdraw your unprocessed funds in your disbursement account? Withdrawals are made to your settlement account.
                                        </p>
                                    </div>
                                    <div class="flex flex-row-reverse gap-2 p-4 md:p-5 rounded-b dark:border-gray-600">
                                        <button type="button"
                                            class="text-[#FFFFFF] bg-[#00ace2] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Withdraw funds</button>
                                        <button data-modal-hide="withdraw-funds-modal" type="button"
                                            class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-full border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                </ul>
                <ul role="list">
                <li class="py-2 sm:py-3">
                    <div class="flex items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-base font-light">Account number</p>
                    </div>
                    <div class="inline-flex space-x-2 items-center text-sm font-medium">
                        <p id="settings-virtual-account">{{ user?.business?.virtualAccount?.account_number ?? '--' }}</p>
                        <a href="#" @click="copyToClipboard()"
                            data-tooltip-target="tooltip-click" data-tooltip-trigger="click" type="button" class="">
                        <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        >
                        <rect
                            x="5.83167"
                            y="5.83203"
                            width="11.6715"
                            height="11.6715"
                            rx="1.66667"
                            stroke="white"
                            stroke-opacity="0.7"
                            stroke-width="1.25"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M5.83155 14.1686H4.16419C3.24333 14.1686 2.49683 13.4221 2.49683 12.5012V4.16443C2.49683 3.24357 3.24333 2.49707 4.16419 2.49707H12.501C13.4219 2.49707 14.1684 3.24357 14.1684 4.16443V5.83179"
                            stroke="white"
                            stroke-opacity="0.7"
                            stroke-width="1.25"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        </svg>
                        </a>
                        <div id="tooltip-click" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Copied
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    </div>
                </li>
                <li class="py-2 sm:py-3">
                    <div class="flex items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-base font-light">Bank name</p>
                    </div>
                    <div class="inline-flex space-x-2 items-center text-sm font-medium">
                        <p>{{ user?.business?.virtualAccount?.bank_name ?? '--' }}</p>
                    </div>
                    </div>
                </li>
                <li class="py-2 sm:py-3">
                    <div class="flex items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-base font-light">Account name</p>
                    </div>
                    <div
                        class="inline-flex space-x-2 items-center text-sm truncate font-medium"
                    >
                        <p>{{ user?.business?.virtualAccount?.account_name ?? '--' }}</p>
                    </div>
                    </div>
                </li>
                </ul>
            </div>
        </div>
        <div class="mt-4">
            <p class="text text-sm text-[#667085] font-normal">To fund your disbursement account, transfer to your virtual account number above.</p>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from "vue"

const props = defineProps({
    actionWord: String,
})

</script>

<template>
    <div id="approve-decline-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-medium text-[#101828] dark:text-white">
                        <span v-if="actionWord=='Activate'">Activate role</span> 
                        <span v-if="actionWord=='Deactivate'">Deactivate role</span>
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="approve-decline-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div v-if="actionWord=='Activate'" class="px-4 md:px-5 py-2 space-y-4">
                    <p
                        class="flex text-sm  text-[#475467] dark:text-gray-400">
                        Are you sure you want to activate this role? Once activated, all members linked to this role will regain their access and new members can be assigned this role.
                    </p>
                </div>
                <div v-if="actionWord=='Deactivate'" class="px-4 md:px-5 py-2 space-y-4">
                    <p
                        class="flex text-sm  text-[#475467] dark:text-gray-400">
                        Are you sure you want to deactivate this role? Once deactivated, all members linked to this role will lose their access.
                    </p>
                </div>
                <div class="flex flex-row-reverse gap-2 p-4 md:p-5 rounded-b dark:border-gray-600">
                    <button v-if="actionWord=='Activate'" data-modal-hide="approve-decline-modal" type="button"
                        class="text-[#FFFFFF] bg-[#00ace2] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Activate role</button>
                    <button v-if="actionWord=='Deactivate'" data-modal-hide="approve-decline-modal" type="button"
                        class="text-[#FFFFFF] bg-[#D92D20] focus:ring-2 focus:outline-none focus:ring-b[#D92D20] font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-[#D92D20] dark:hover:bg-[#D92D20] dark:focus:ring-[#D92D20]">Deactivate role</button>
                    <button data-modal-hide="approve-decline-modal" type="button"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-full border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>
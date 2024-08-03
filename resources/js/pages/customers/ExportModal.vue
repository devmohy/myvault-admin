<script setup>
import{ ref, reactive, onMounted, computed } from "vue";
import { useToast } from 'vue-toastification';
import api from '@/api';
const toast = useToast();

const form = reactive({
  from: "",
  to: "",
});

const formErrors = reactive({
  from: false,
  to: false,
  compare_from_to_date: false
});

const isLoading = ref(false);

function exportTransactionAsCSV() {
    try {
        validateForm();
        isLoading.value = true;
        const formData = {
            fromDate: form.from,
            toDate: form.to
        };
        toast.info('Download started');
        api.post("loans/export", formData, {responseType: 'blob'}).then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'loans.csv');
                document.body.appendChild(link);
                link.click();
        });
    } catch (error) {
        console.log("error", error);
        toast.error(error.response.message);
    } finally {
        isLoading.value = false
        setTimeout(() => { document.getElementById("export-transaction-btn").click();}, 1000);
    }
}

function validateForm() {

    if (form.from == '') {
        formErrors.from = true;
        return;
    }
    formErrors.from = false;
    if (form.to == '') {
        formErrors.to = true;
        return;
    }
    formErrors.to = false;

    if(new Date(form.from) > new Date(form.to)) {
        formErrors.compare_from_to_date = true;
        return;
    };
    formErrors.compare_from_to_date = false;

    isLoading.value = false
    
    return true;
}

</script>

<template>
    <div id="export-transaction-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-medium text-[#101828] dark:text-white">
                        <span>Export Loan</span>
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="export-transaction-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                
                <div class="px-4 py-2 md:px-5 py-2 space-y-4">
                    <div>
                        <div class="my-2">
                            <label
                                for="cycle-starts-date-picker"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >From</label
                            >
                            <input
                                type="date"
                                id="cycle-starts-date-picker"
                                name="cycle-starts-date-picker"
                                v-model="form.from"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select cycle start date"
                                required
                            />
                            <div v-if="formErrors.from" class="text-red-500 text-sm mt-1">select from date</div>
                        </div>

                        <div class="my-2">
                            <label
                                for="cycle-ends-date-picker"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >To</label
                            >
                            <input
                                type="date"
                                id="cycle-ends-date-picker"
                                name="cycle-ends-date-picker"
                                v-model="form.to"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select cycle end date"
                                required
                            />
                            <div v-if="formErrors.to" class="text-red-500 text-sm mt-1">select to date</div>
                            <div v-if="formErrors.compare_from_to_date" class="text-red-500 text-sm mt-1">Must be after From date</div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row-reverse gap-2 p-4 md:p-5 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-[#FFFFFF] bg-[#00ace2] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click.prevent="exportTransactionAsCSV()" :disabled="isLoading">{{ isLoading ? "Downloading..." : "Download" }}</button>
                    <button data-modal-hide="export-transaction-modal" id="export-transaction-btn" type="button"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-full border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                 </div>
            </div>
        </div>
    </div>
</template>
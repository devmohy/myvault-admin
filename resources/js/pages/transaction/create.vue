<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import InputField from "@/components/InputField.vue";
import SelectField from "@/components/SelectField.vue";
import AmountField from "@/components/AmountField.vue";
import GoBack from "@/components/GoBack.vue";
import { ref, onMounted, computed } from "vue";
import TextAreaField from "@/components/TextAreaField.vue";

const loanTypes = [
  'Rent Loan'
]
const employees = [
  'Nelly Anjola'
]
const schedules = [
  'Monthly'
]

onMounted(() => {});
</script>

<template>
  <AppLayout>
    <div class="relative">
      <form action="#" class="max-h-[80vh] overflow-y-auto">
        <div class="pt-6">
          <div class="grid grid-cols-12">
            <GoBack />
          </div>
          <div class="text text-center text-2xl text-[#101828]">Book a loan</div>
        </div>

        <div class="flex flex-col items-center gap-4 mt-10 pb-8">
          <div
            class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
          >
            <span class="text-base font-semibold text-[#101828] dark:text-white"
              >Loan details</span
            >
            <div class="mt-8">
              <SelectField
                id="loan_type"
                label="Loan type"
                :options="loanTypes"
                
              />
              <SelectField
                id="employee"
                label="Employee"
                :options="employees"
                
              />
              <AmountField
                id="amount"
                label="Amount"
                type="text"
                placeholder="Enter loan amount"
              />
              <InputField
                id="tenor"
                label="Tenor"
                type="text"
                placeholder="0"
              />
              <SelectField
                id="schedule"
                label="Schedule"
                :options="schedules"
              />
              <TextAreaField
                id="reason"
                label="Reason"
                placeholder="Pay for rent"
              />
            </div>
          </div>
        </div>
      </form>
      <div class="sticky bottom-0 left-0 flex flex-row-reverse right-0 pt-6 border-t">
        <button type="button" class="btn btn-primary w-auto px-4">Book loan</button>
      </div>
    </div>
  </AppLayout>
</template>

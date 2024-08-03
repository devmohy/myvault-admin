<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import InputField from "@/components/InputField.vue";
import SelectField from "@/components/SelectField.vue";
import AmountField from "@/components/AmountField.vue";
import InputNumber from 'primevue/inputnumber';

import GoBack from "@/components/GoBack.vue";
import TextAreaField from "@/components/TextAreaField.vue";
import { useLoanTypes } from "@/composables/useLoanTypes";
import { ref, onMounted, reactive, computed } from "vue";
const { loanType, loanTypes, fetchLoanType, fetchLoanTypes } = useLoanTypes();
import { useEmployees } from "@/composables/useEmployees";
const { employees, employee, stats, fetchEmployee, fetchEmployees, isLoading } = useEmployees();
import { useLoans } from "@/composables/useLoans";
const { createLoan } = useLoans();
const schedules = ["Monthly"];
const form = reactive({
  employee_id: "",
  loan_type_id: "",
  amount: "",
  tenor: loanType.value.tenure,
  schedule: "Monthly",
  reason: "",
});

const amountEligible = computed(() => {
  if (loanType.value && employee.value) {
    return (loanType.value.eligible_percent_in_salary_gross / 100) * employee.value.annual_gross_salary?.replace(/,/g, "");
  }
  return 0;
});

const amount = computed(() => form.amount.replace(/[^0-9.]/g, ""));
onMounted(async () => {
  await fetchLoanTypes();
  await fetchEmployees();
});
const isFormInvalid = computed(() => {
  return (
    form.employee_id === "" ||
    form.loan_type_id === "" ||
    form.amount === "" ||
    form.tenor === "" ||
    form.schedule === "" ||
    form.reason === "" ||
    parseFloat(amount.value) > parseFloat(amountEligible.value)
  );
});
async function bookLoan() {
  isLoading.value = true
  const bookLoanData = {
    employee_id: form.employee_id,
    loan_type_id: form.loan_type_id,
    amount: parseFloat(amount.value),
    tenor: form.tenor,
    schedule: form.schedule,
    reason: form.reason,
  };

  await createLoan(bookLoanData);

  setTimeout(() => {
    isLoading.value = false;
    window.location.href = "/loans";
  }, 2000);
}

// console.log(loanTypes)
</script>

<template>
  <AppLayout>
    <div class="relative">
      <form @submit.prevent="bookLoan" class="max-h-[80vh] overflow-y-auto">
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
                <div class="mb-[16px]">
                  <label
                    for="loan_type"
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                    >Loan type</label
                  >
                  <Multiselect
                    label="name"
                    :searchable="true"
                    v-model="form.loan_type_id"
                    :options="
                      Object.assign(
                        {},
                        ...loanTypes.map((loanType) => ({ [loanType.id]: loanType.name }))
                      )
                    "
                    @change="fetchLoanType($event)"
                  />
                </div>
                <div class="mb-[16px]">
                  <label
                    for="employee"
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                    >Employee</label
                  >
                  <Multiselect
                    label="name"
                    :searchable="true"
                    v-model="form.employee_id"
                    :options="
                      Object.assign(
                        {},
                        ...employees.map((employee) => ({ [employee.id]: employee.name }))
                      )
                    "
                    @change="fetchEmployee($event)"
                  />
                </div>
                
                <AmountField
                  id="amount"
                  label="Amount"
                  v-model="form.amount"
                  type="number"
                  placeholder="Enter loan amount"
                />
                <TextAreaField
                  id="reason"
                  v-model="form.reason"
                  label="Reason"
                  placeholder="Pay for rent"
                />
              </div>
          </div>
        </div>
        <div class="sticky bottom-0 left-0 flex flex-row justify-between right-0 pt-6 border-t bg-white">
          <div>
            <p>Amount Eligibile: NGN {{ isNaN(amountEligible) ? 0 : amountEligible.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}}</p>
            <p>Tenor: {{ isNaN(amountEligible) ? 0 : parseInt(loanType.tenure) }} Months</p>
          </div>
          <button
            :disabled="isFormInvalid || isLoading"
            type="submit"
            class="btn btn-primary w-auto px-4"
          >
            {{ isLoading ? "Booking loan..." : "Book loan" }}
          </button>
        </div>
        </form>
    </div>
  </AppLayout>
</template>
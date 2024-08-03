<script setup>
import DetailAccordion from "@/components/DetailAccordion.vue";
import { ref, onMounted } from "vue";

const props = defineProps({
  employeeDetails: Object,
});


</script>
<template>
  <div class="hidden" id="employee" role="tabpanel" aria-labelledby="employee-tab">
    <DetailAccordion title="Employee details" id="employee">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">name</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ? props.employeeDetails.name : '' }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">email address</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ? props.employeeDetails.email_address : '' }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">phone number</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ? props.employeeDetails.phone_number : '' }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">employment date</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ?  props.employeeDetails.employement_date : '' }}</p>
          </div>

          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">job title</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ? props.employeeDetails.job_title : '' }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">current salary</p>
            <p class="text-sm text-[#101828]">₦ {{ props.employeeDetails ? props.employeeDetails.annual_net_salary : '' }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">bank name</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ? props.employeeDetails.bankDetails.bank_name : '' }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">account number</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ? props.employeeDetails.bankDetails.account_number : '' }}</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">account name</p>
            <p class="text-sm text-[#101828]">{{ props.employeeDetails ? props.employeeDetails.bankDetails.account_name : '' }}</p>
          </div>
        </div>
      </div>
    </DetailAccordion>
  </div>
</template>

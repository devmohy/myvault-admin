<script setup>
import DetailAccordion from "@/components/DetailAccordion.vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import { ref, onMounted } from "vue";

const props = defineProps({
  payrollDetails: Object,
});


</script>
<template>
  <div class="hidden" id="payroll" role="tabpanel" aria-labelledby="payroll-tab">
    <DetailAccordion title="Payroll details" id="payroll">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs text-[#667085] font-normal">PAYROLL NAME</p>
            <p class="text-sm text-[#101828] font-normal">{{ props.payrollDetails ? props.payrollDetails.name : '' }}</p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal">CYCLE STARTS</p>
            <p class="text-sm text-[#101828] font-normal">{{  props.payrollDetails ? props.payrollDetails.cycle_starts : '' }}</p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal">CYCLE ENDS</p>
            <p class="text-sm text-[#101828] font-normal">{{  props.payrollDetails ? props.payrollDetails.cycle_ends : '' }}</p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal">STATUS</p>
            <StatusBadge :status="props.payrollDetails ? props.payrollDetails.status : 'pending'" />
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal">TOTAL DISBURSEMENT AMOUNT</p>
            <p class="text-sm text-[#101828] font-normal">₦ {{ props.payrollDetails ? props.payrollDetails.amount_disbursed : 0 }}</p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal">TOTAL SMS/EMAIL FEES</p>
            <p class="text-sm text-[#101828] font-normal">₦ {{ props.payrollDetails ? props.payrollDetails.sms_fee : 0 }}</p>
          </div>
          <div>
            <p class="text-xs text-[#667085] font-normal">TOTAL AMOUNT TO FUND</p>
            <p class="text-sm text-[#101828] font-normal">₦ {{ props.payrollDetails ? props.payrollDetails.amount_to_fund : 0 }}</p>
          </div>
        </div>
      </div>
    </DetailAccordion>
  </div>
</template>

<script setup>
import DetailAccordion from "@/components/DetailAccordion.vue";
import { ref, onMounted } from "vue";

</script>
<template>
  <div class="hidden" id="loan" role="tabpanel" aria-labelledby="loan-tab">
    <DetailAccordion title="Loan details" id="loan">
      <div class="p-5 border border-b-1 border-t-0 rounded-b-xl border-gray-200">
        <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">Loan ID</p>
            <p class="text-sm text-[#101828] font-normal">JK9921WE098</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">LOAN TYPE</p>
            <p class="text-sm text-[#101828]">Rent Loan</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">loan amount</p>
            <p class="text-sm text-[#101828]">Jun 20, 2023</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">tenor</p>
            <p class="text-sm text-[#101828]">6 months</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">reason</p>
            <p class="text-sm text-[#101828]">PAY FOR RENT</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">status</p>
            <StatusBadge status="pending" />
          </div>
          <div>
            <p class="text-sm text-[#667085] font-normal">AMOUNT PAID</p>
            <p class="text-sm text-[#101828]">₦500,000.00</p>
          </div>
          <div>
            <p class="text-sm text-[#667085] font-normal">AMOUNT OUTSTANDING</p>
            <p class="text-sm text-[#101828]">₦400,000.00</p>
          </div>
          <div>
            <p class="text-xs mb-2 text-[#667085] uppercase">Next payment date</p>
            <p class="text-sm text-[#101828]">Feb 20, 2024</p>
          </div>
        </div>
      </div>
    </DetailAccordion>
  </div>
</template>

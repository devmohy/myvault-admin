<script setup>
import { ref, onMounted, reactive, computed } from "vue";
import BusinessDetails from "@/components/settings/business-details/BusinessDetails.vue";
import Documents from "@/components/settings/business-details/Documents.vue";
import SettlementBank from "@/components/settings/business-details/SettlementBank.vue";
import { useBusinesses } from "@/composables/useBusinesses";
import { useBusinessesSettings } from "@/composables/useBusinessesSettings";
const { fetchDocuments, documents } = useBusinesses();
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const { business, fetchBusiness } = useBusinessesSettings();
onMounted(async () => {
  await fetchBusiness(authStore.user.business.id);
});
</script>
<template>
  <div
    class="hidden"
    id="business-details"
    role="tabpanel"
    aria-labelledby="business-details-tab"
  >
    <BusinessDetails :business="business" />
    <Documents />
    <SettlementBank  :business="business" />
  </div>
</template>

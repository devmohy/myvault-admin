<script setup>
import PlatformOwnerLayout from "@/layout/AppLayout.vue";
import { useToast } from "vue-toastification";
import { ref, onMounted, reactive, computed, onBeforeMount } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import eventTypes from "@/eventTypes.js";
import api from "@/api";
import { useAuditTrail } from "@/composables/useAuditTrail";
const {
  audits,
  pagination,
  search,
  filters,
  fetchAuditTrail,
  setPage,
  isLoading
} = useAuditTrail();

const router = useRouter();
const toast = useToast();
const authStore = useAuthStore();

const hasButton = ref(false);
const isFilter = ref(false);

const formatter = ref({
  date: "DD MMM YYYY",
  month: "MMM",
});

import columns from "@/columns/auditTrail";

function handlePageChange(page) {
  setPage(page);
  fetchAuditTrail();
}

function handleSearch(searchTerm) {
  isFilter.value = true;
  search.value = searchTerm;
  fetchAuditTrail();
}

const handleFilter = async () => {
  isFilter.value = true;
  setPage(1);
  await fetchAuditTrail();
  filters.value = {
    event_type: '',
    date_range: []
  }
};

fetchAuditTrail()
</script>

<template>
  <PlatformOwnerLayout>
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Audit log"
        sub-title="All users activities"
        @back="() => $router.go(-1)"
      >
        <template #extra>
          <!-- <a-button key="1" type="primary">Primary</a-button> -->
        </template>
      </a-page-header>
    </template>
    <a-table
      :columns="columns"
      :row-key="(record) => record.id"
      :data-source="audits"
      :pagination="pagination"
      :loading="isLoading"
      @change="handleTableChange"
    >
      <template #bodyCell="{ column, text, record}">
        <template v-if="column.dataIndex === 'name'">
          <router-link :to="'/customers/' + record?.id">{{ text }}</router-link>
        </template>
      </template>
    </a-table>
  </PlatformOwnerLayout>
</template>

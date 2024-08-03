<script setup>
import BusinessLayout from "@/layout/AppLayout.vue";
import Pagination from "@/components/pagination/index.vue";
import PageHeader from "@/components/MainContainerHeader.vue";
import DataTable from "@/components/table/index.vue";
import EmptyTable from "@/components/table/empty.vue";
import SelectField from "@/components/SelectField.vue";
import CreateRole from "@/pages/role/CreateRole.vue";
import EditRole from "@/pages/role/EditRole.vue";
import ApproveDeclineModal from "@/components/role/ApproveAndDeclineModal.vue";
import { useUserAccess } from "@/utils/userAccess";
import { useRoles } from "@/composables/useRoles";
import { useToast } from "vue-toastification";
import { ref, onMounted, computed, reactive } from "vue";
import { useRouter, useRoute } from "vue-router";
import { can } from "@/utils/permissions";
const router = useRouter();
const toast = useToast();
const {
  roles,
  pagination,
  role,
  search,
  filters,
  fetchRoles,
  fetchRole,
  setPage,
  isLoading
} = useRoles();
import columns from "@/columns/roles";
const route = useRoute();

const isAdmin = computed(() => {
  return false;
});
const actionWord = ref("Delete");
const roleId = ref("");
const editRole = ref(false);
const isFilter = ref(false);
const newRole = ref(role);

const activeTabName = ref("");

const formatter = ref({
  date: "DD MMM YYYY",
  month: "MMM",
});

const handleBookLoanBtn = () => {
  router.push("/loans/book");
};
const handleSearch = async (searchTerm) => {
  isFilter.value = true;
  search.value = searchTerm;
  await fetchRoles();
};
const handleFilter = async () => {
  isFilter.value = true;
  setPage(1);
  await fetchRoles();

  filters.value = {
    status: '',
    date_range: []
  }
};

const getSingleRole = async (roleId) => {
  await fetchRole(roleId);
};

const handlePageChange = async (page) => {
  setPage(page);
  await fetchRoles();
};

onMounted(async () => {
  isLoading.value = true;
  await fetchRoles();
});
const open = ref(false);
const showDrawer = () => {
  open.value = true;
};
</script>

<template>
  <BusinessLayout :isLoading="isLoading">
    <template #pageHeader>
      <a-page-header
        class="demo-page-header"
        style="border: 1px solid rgb(235, 237, 240)"
        title="Roles"
        @back="() => $router.go(-1)"
      >
        <template #extra>
          <a-button key="1" @click="showDrawer">Create Role</a-button>
        </template>
      </a-page-header>
    </template>
    <a-table
      :columns="columns"
      :row-key="(record) => record.id"
      :data-source="roles"
      :pagination="pagination"
      :loading="isLoading"
      @change="handleTableChange"
    >
    <template #bodyCell="{ column, text, record }">
        <template v-if="column.dataIndex === 'customer_name'">
          <router-link :to="'/customers/' + record?.id">{{ text }}</router-link>
        </template>
        <template v-if="column.dataIndex === 'status'">
          <a-tag color="success" v-if="record.status == 'active'">ACTIVE</a-tag>
          <a-tag color="red" v-else>IN ACTIVE</a-tag>
        </template>

      </template>
    </a-table>
    <CreateRole  v-if="can('edit_role')" :open="open"
    @update:open="open = $event" />
    <ApproveDeclineModal :actionWord="actionWord" :roleId="roleId" />
    <EditRole :role="role" :editRole="editRole" v-if="can('edit_role')" />
  </BusinessLayout>
</template>

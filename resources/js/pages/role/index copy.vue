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
</script>

<template>
  <BusinessLayout :isLoading="isLoading">
    <div>
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a
              href="#"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-400 dark:text-gray-400 dark:hover:text-white"
            >
              Roles
            </a>
          </li>
        </ol>
      </nav>
    </div>
    <PageHeader
      page="Roles"
      pageBtnAction="Create role"
      :handleBtn="handleBookLoanBtn"
      :hasBtn="can('create_role')"
      btnType="drawer"
      btnIcon="plus"
      drawerTarget="create-role-drawer-right"
      :tabs="[]"
    />
    <CreateRole  v-if="can('edit_role')" />
    <ApproveDeclineModal :actionWord="actionWord" :roleId="roleId" />
    <div class="border bg-white border-solid rounded-lg dark:border-gray-700">
      <div v-if="roles?.length > 0 || isFilter">
        <DataTable
          :columns="columns"
          :dataSource="roles"
          :handleSearch="handleSearch"
          :handleFilter="handleFilter"
          :showSearch="true"
          :showFilter="true"
          searchPlaceholder="Searh role name"
          :searchValue="search"
        >
          <!-- Custom action title slot -->
          <template #actionTitle=""></template>
          <!-- Custom actions slot -->
          <template #actions="{ item }">
            <button
              :id="'dropdownMenuIconButton-' + item.id"
              :data-dropdown-toggle="'dropdownDots-' + item.id"
              class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
              type="button"
            >
              <svg
                class="w-5 h-5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 4 15"
              >
                <path
                  d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"
                />
              </svg>
            </button>
            <div
              :id="'dropdownDots-' + item.id"
              class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44"
            >
              <ul class="p-2 text-sm text-gray-700" aria-labelledby="dropdownMoreButton">
                <li>
                  <a
                    data-drawer-target="edit-role-drawer-right"
                    data-drawer-show="edit-role-drawer-right"
                    data-drawer-placement="right"
                    aria-controls="edit-role-drawer-right"
                    @click.prevent="getSingleRole(item.id), (editRole = false)"
                    href="#"
                    class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                    >View</a
                  >
                </li>
                <li>
                  <a
                    data-drawer-target="edit-role-drawer-right"
                    data-drawer-show="edit-role-drawer-right"
                    data-drawer-placement="right"
                    aria-controls="edit-role-drawer-right"
                    href="#"
                    @click.prevent="getSingleRole(item.id), (editRole = true)"
                    class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                    >Edit</a
                  >
                </li>
                <li v-if="item.status == 'active'">
                  <a
                    data-modal-target="approve-decline-modal"
                    data-modal-toggle="approve-decline-modal"
                    @click.prevent="(actionWord = 'Deactivate'), (roleId = item.id)"
                    href="#"
                    class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                    >Deactivate</a
                  >
                </li>
                <li v-if="item.status == 'inactive'">
                  <a
                    data-modal-target="approve-decline-modal"
                    data-modal-toggle="approve-decline-modal"
                    @click.prevent="(actionWord = 'Activate'), (roleId = item.id)"
                    href="#"
                    class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                    >Activate</a
                  >
                </li>
              </ul>
            </div>
          </template>

          <template #filter>
            <form class="mb-6">
              <SelectField
                v-model="filters.status"
                id="status"
                label="Status"
                placeholder="Select status"
                :options="[
                  { id: 'active', name: 'Active' },
                  { id: 'inactive', name: 'Inactive' },
                ]"
              />
              <div class="mb-[16px]">
                <label
                  for="dateRange"
                  class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                  >Date Range</label
                >
                <VueTailwindDatepicker
                  :formatter="formatter"
                  v-model="filters.date_range"
                  input-classes="input-field p-[12px]"
                  as-single
                  use-range
                />
              </div>
              <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
                <button
                  data-drawer-hide="filter-drawer-right"
                  aria-controls="filter-drawer-right"
                  type="button"
                  class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
                >
                  Cancel
                </button>
                <button
                  data-drawer-hide="filter-drawer-right"
                  type="button"
                  @click="handleFilter"
                  class="text-[#FFFFFF] bg-[#00ace2] hover:bg-[#00ace2] focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-[#F2F4F7] dark:hover:bg-[#F2F4F7] focus:outline-none dark:focus:ring-[#F2F4F7] block"
                >
                  Apply filters
                </button>
              </div>
            </form>
          </template>
        </DataTable>
        <Pagination :pagination="pagination" @pageChange="handlePageChange" />
      </div>
      <div v-else>
        <EmptyTable>
          <template #empty-table-message-title> Roles will appear here </template>
          <template #empty-table-message-body>
            No roles have been created yet. When they do, they will appear here.
          </template>
        </EmptyTable>
      </div>
    </div>

    <EditRole :role="role" :editRole="editRole" v-if="can('edit_role')" />
  </BusinessLayout>
</template>

<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import Pagination from "@/components/pagination/index.vue";
import DataTable from "@/components/table/index.vue";
import EmptyTable from "@/components/table/empty.vue";
import SvgIcon from "@/components/SvgIcons.vue";
import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();
import ActivateAndDeactivateMemberModal from "./team-member-components/ActivateAndDeactivateMemberModal.vue";
import EditTeamMemberDrawer from "@/pages/team-members/team-member-components/EditTeamMemberDrawer.vue";
import { ref, onMounted, reactive } from "vue";
import { initFlowbite } from "flowbite";
import { useTeamMembers } from "@/composables/useTeamMembers";
import { useToast } from "vue-toastification";
import api from "@/api";
const toast = useToast();
const { fetchTeamMember, teamMember, reinviteTeamMember } = useTeamMembers();
import { can } from "@/utils/permissions";
import { Modal } from "flowbite";
const props = defineProps({
  id: String,
});
const search = ref(""); // Search string
const filters = ref({
  event_type: "",
});
const pagination = reactive({
  current_page: 1, // Set default current page to 1
  per_page: 10,
  total: 0,
  next_page_url: null,
  prev_page_url: null,
});
var teamMemberId = ref("");
const isLoading = ref(false);
const listOfAuditTrails = ref([]);
const getListOfAuditTrailsByUserId = async () => {
  try {
    isLoading.value = true;
    const params = {
      filters: filters.value, // Pass the array of filters
      search: search.value,
      page: pagination.current_page,
      userId: props.id,
    };
    await api.get("/audit", { params }).then((response) => {
      listOfAuditTrails.value = response.data.data;
      pagination.current_page = response.data.pagination.current_page;
      pagination.per_page = response.data.pagination.per_page;
      pagination.total = response.data.pagination.total;
      pagination.next_page_url = response.data.pagination.next_page_url;
      pagination.prev_page_url = response.data.pagination.prev_page_url;
    });
  } catch (error) {
    console.log("error: ", error);
    toast.error(error.message);
  } finally {
    isLoading.value = false;
  }
};

const columns = [
  {
    title: "TEAM MEMBER",
    dataIndex: "team_member",
    key: "team_member",
    sort: true,
    width: "2000",
  },
  {
    title: "EVENT TYPE",
    dataIndex: "event_type",
    key: "event_type",
    sort: true,
  },
  {
    title: "DESCRIPTION",
    dataIndex: "description",
    key: "description",
    sort: false,
  },
  {
    title: "TMESTAMP",
    dataIndex: "date_created",
    key: "date_created",
    sort: true,
  },
];
function handlePageChange(page) {
  pagination.current_page = page;
  getListOfAuditTrailsByUserId();
}
initFlowbite();

const handleResendIvite = async (email, role_id) => {
  const roleData = {
    email: email,
    role_id: role_id,
  };
  await reinviteTeamMember(roleData);
  // setTimeout(() => {
  //     isLoading.value = false;
  //     window.location.reload();
  //   }, 2000);
};
let confirmModal = null;
const actionWord = ref("");
onMounted(async () => {
  isLoading.value = true;
  await fetchTeamMember(props.id);
  await getListOfAuditTrailsByUserId();

  const confirmation = document.querySelector("#activate-deactivate-modal");
  const modalOptions = {
    backdropClasses: "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
  };

  confirmModal = new Modal(confirmation, modalOptions);
});

const showConfirmationModal = async (action, id) => {
  actionWord.value = action;
  teamMemberId.value = id;
  confirmModal.show();
};
</script>

<template>
  <AppLayout>
    <div>
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <router-link
              :to="isAdmin ? '/admin/team-members' : '/team-members'"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-400 dark:text-gray-400 dark:hover:text-white"
            >
              Team members
            </router-link>
          </li>
          <li>
            <div class="flex items-center">
              <SvgIcon icon="arrowRight" />
              <a
                href="#"
                class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-400 md:ms-2 dark:text-gray-400 dark:hover:text-white"
              >
                {{ teamMember.member_name }}</a
              >
            </div>
          </li>
        </ol>
      </nav>
    </div>
    <div
      class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 pt-8 bg dark:bg-gray-900"
    >
      <div class="flex flex-row gap-2">
        <div class="">
          <p class="text-2xl text-[#101828] font-semibold">
            {{ teamMember.member_name }}
          </p>
        </div>
      </div>
      <div class="flex gap-1">
        <button
          id="dropdownTeamMember"
          data-dropdown-toggle="dropdown"
          type="button"
          class="flex text-white bg-[#00ace2] hover:bg-[#00ace2] focus:outline-none focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-[00ace2] dark:hover:bg-[00ace2] dark:focus:ring-green-800"
        >
          Actions
          <svg
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.6665 8.33203L9.99984 11.6654L13.3332 8.33203"
              stroke="white"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
        <div
          id="dropdown"
          class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
        >
          <ul
            class="py-2 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownTeamMember"
          >
            <li v-if="can('invite_team')">
              <a
                data-drawer-target="edit-team-member-drawer-right"
                data-drawer-show="edit-team-member-drawer-right"
                data-drawer-placement="right"
                aria-controls="edit-team-member-drawer-right"
                href="#"
                class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
              >
                Edit
              </a>
            </li>
            <li v-if="teamMember.status == 'active' && can('deactivate_team')">
              <a
                @click.prevent="showConfirmationModal('Deactivate', teamMember.id)"
                href="#"
                class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                >Deactivate</a
              >
            </li>
            <li v-if="teamMember.status == 'inactive' && can('activate_team')">
              <a
                @click.prevent="showConfirmationModal('Activate', teamMember.id)"
                href="#"
                class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
                >Activate</a
              >
            </li>

            <li
              v-if="
                teamMember.status == 'pending' &&
                teamMember.password == null &&
                can('invite_team')
              "
            >
              <button
                @click="handleResendIvite(teamMember.email, teamMember.role_id)"
                class="text text-[#344054] block px-4 py-2 rounded-md hover:bg-gray-100"
              >
                Resend Invite
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div
      class="gap-4 p-6 my-4 border border-gray-200 bg-[#FFFFFF] rounded-lg overflow-y-scroll"
    >
      <div class="w-full text-base text-[#101828] font-semibold pb-3">Basic Details</div>
      <div class="grid gap-x-6 gap-y-4 md:grid-cols-4">
        <div>
          <p class="text-xs text-[#667085] font-normal mb-2">NAME</p>
          <p class="text-sm text-[#101828] font-normal">{{ teamMember.member_name }}</p>
        </div>
        <div style="overflow-wrap: break-word">
          <p class="text-xs text-[#667085] font-normal mb-2">EMAIL ADDRESS</p>
          <p class="text-sm text-[#101828] font-normal">{{ teamMember.email }}</p>
        </div>
        <div v-if="teamMember.status !== undefined">
          <p class="text-xs text-[#667085] font-normal mb-2">STATUS</p>
          <StatusBadge :status="teamMember.status" />
        </div>
        <div>
          <p class="text-xs text-[#667085] font-normal mb-2">ROLE</p>
          <p class="text-sm text-[#101828] font-normal">{{ teamMember.role }}</p>
        </div>
      </div>
    </div>
    <div
      class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-4 mt-5"
    >
      <ul class="flex flex-wrap -mb-px">
        <li class="me-2">
          <a
            href="#"
            class="inline-block border-b-2 border-[#00ace2] rounded-t-lg active dark:border-gray-200"
            aria-current="page"
          >
            <div
              class="inline-flex items-center px-5 py-2.5 text-sm text-center text-[#2E637A] bg-[#F8FBFC] hover:bg-gray-200"
            >
              <span class="text-sm">Activity log</span>
            </div>
          </a>
        </li>
      </ul>
    </div>

    <div class="border bg-white border-solid rounded-lg dark:border-gray-700">
      <div v-if="listOfAuditTrails?.length > 0">
        <DataTable
          :columns="columns"
          :dataSource="listOfAuditTrails"
          :handleSearch="handleSearch"
          :handleFilter="handleFilter"
          :showSearch="false"
          :showFilter="false"
          searchPlaceholder="Search audit by name"
        >
          <template #filter>
            <form class="mb-6">
              <div class="mb-6 text-sm font-medium text-gray-900 dark:text-white">
                <label
                  for="roles"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Event type</label
                >
                <select
                  id="roles"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                  <option selected>Select event type</option>
                  <option value="owner">Create Payroll</option>
                </select>
              </div>
              <!-- <div class="relative col-span-2 block mb-6 text-sm font-medium text-gray-900 dark:text-white">
                                <div class="absolute inset-y-10 end-3.5 flex  ps-3 pointer-events-none">
                                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <label for="date-picker"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select date
                                    date</label>
                                <input type="date" id="date-picker" name="date-picker"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select employment date" required>
                            </div> -->
              <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
                <button
                  data-drawer-hide="filter-drawer-right"
                  aria-controls="filter-drawer-right"
                  type="submit"
                  class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
                >
                  Cancel
                </button>
                <button
                  type="submit"
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
          <template #empty-table-message-title>
            <div v-if="search?.length != ''" class="flex flex-col">
              <span>No Audit trail with searched value</span>
              <!-- <a href="/audit">Go back</a> -->
            </div>
            <span v-else>Audit trail list will appear here</span>
          </template>
          <template #empty-table-message-body>
            <span v-if="search?.length != ''"></span>
            <span v-else>
              No audit trail added yet. When they do, they will appear here.</span
            >
          </template>
        </EmptyTable>
      </div>
    </div>
    <ActivateAndDeactivateMemberModal
      :actionWord="actionWord"
      :teamMemberId="teamMember.id"
      :modal="confirmModal"
    />
    <EditTeamMemberDrawer :teamMember="teamMember" />
  </AppLayout>
</template>

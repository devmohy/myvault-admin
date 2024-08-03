<script setup>
import BusinessLayout from "@/layout/AppLayout.vue";
import InviteTeamMember from "@/pages/team-members/team-member-components/InviteTeamMemberDrawer.vue";
import ActivateAndDeactivateMemberModal from "./team-member-components/ActivateAndDeactivateMemberModal.vue";
import Pagination from "@/components/pagination/index.vue";
import PageHeader from "@/components/PageHeader.vue";
import SvgIcons from "@/components/SvgIcons.vue";
import DataTable from "@/components/table/index.vue";
import EmptyTable from "@/components/table/empty.vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import InputField from "@/components/InputField.vue";
import SelectField from "@/components/SelectField.vue";
import AmountField from "@/components/AmountField.vue";
import { ref, onMounted, computed } from "vue";
import { useTeamMembers } from "@/composables/useTeamMembers";
import { useRoles } from "@/composables/useRoles";
import { useToast } from "vue-toastification";
import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();
import { can } from "@/utils/permissions";
import { Modal } from "flowbite";
const {
  teamMembers,
  teamMember,
  filters,
  pagination,
  search,
  isLoading,
  fetchTeamMembers,
  fetchTeamMember,
  reinviteTeamMember,
  setPage,
} = useTeamMembers();
const { roles, fetchRoles } = useRoles();

const formatter = ref({
  date: "DD MMM YYYY",
  month: "MMM",
});

import { useRouter, useRoute } from "vue-router";
import columns from "@/columns/teams";

const actionWord = ref("");
const isFilter = ref(false);
const isInvite = ref(false);

var teamMemberId = ref("");

let confirmModal = null;

onMounted(async () => {
  isLoading.value = true;
  await fetchTeamMembers();
  await fetchRoles(1000);

  const confirmation = document.querySelector("#activate-deactivate-modal");
  const modalOptions = {
    backdropClasses: "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
  };

  confirmModal = new Modal(confirmation, modalOptions);
});

const handlePageChange = async (page) => {
  setPage(page);
  await fetchTeamMembers();
};

const handleSearch = async (searchTerm) => {
  isFilter.value = true;
  search.value = searchTerm;
  await fetchTeamMembers();
};

const handleFilter = async () => {
  isFilter.value = true;
  setPage(1);
  await fetchTeamMembers();
  filters.value = {
    status: "",
    date_range: [],
  };
};

const getSingleTeam = async (id) => {
  await fetchTeamMember(id);
};

const handInviteBtn = async (e) => {
  isInvite.value = true;
  setTimeout(() => {
    isLoading.value = false;
    e.target.click();
  }, 1000);
};
const showConfirmationModal = async (action, id) => {
  actionWord.value = action;
  teamMemberId.value = id;
  confirmModal.show();
};

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
        title="Team members"
        @back="() => $router.go(-1)"
      >
        <template #extra>
          <a-button key="1" @click="showDrawer">Invite Member</a-button>
        </template>
      </a-page-header>
    </template>
    <a-table
      :columns="columns"
      :row-key="(record) => record.id"
      :data-source="teamMembers"
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
    <InviteTeamMember :open="open"
    @update:open="open = $event"/>

    <ActivateAndDeactivateMemberModal
      :actionWord="actionWord"
      :teamMemberId="teamMemberId"
      :modal="confirmModal"
    />
  </BusinessLayout>
</template>

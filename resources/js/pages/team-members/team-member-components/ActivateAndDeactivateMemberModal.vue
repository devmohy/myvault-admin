<script setup>
import { useTeamMembers } from "@/composables/useTeamMembers";
import { Modal } from "flowbite";
const { updateStatus, isLoading } = useTeamMembers();



const props = defineProps({
  actionWord: String,
  teamMemberId: String,
  modal:Modal,
});
const handleActivate = async () => {
  const teamData = {
    status: "active",
  };
  await updateStatus(props.teamMemberId, teamData);
  setTimeout(() => {
    isLoading.value = false;
    window.location.reload();
  }, 2000);
};
const handleDeactivate = async () => {
  const teamData = {
    status: "inactive",
  };
  await updateStatus(props.teamMemberId, teamData);
  setTimeout(() => {
    isLoading.value = false;
    window.location.reload();
  }, 2000);
};

</script>

<template>
  <div
    id="activate-deactivate-modal"
    tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div
          class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600"
        >
          <h3 class="text-lg font-medium text-[#101828] dark:text-white">
            <span v-if="actionWord == 'Activate'">Activate team member</span>
            <span v-if="actionWord == 'Deactivate'">Deactivate team member</span>
          </h3>
          <button
            type="button"
            @click="props.modal.hide()"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            id="closeButton"
          >
            <svg
              class="w-3 h-3"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
              />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div v-if="actionWord == 'Activate'" class="px-4 py-2 md:px-5 py-2 space-y-4">
          <p class="flex text-sm text-[#475467] dark:text-gray-400">
            Activating this team member will restore their access to assigned platform
            features and capabilities.
          </p>
        </div>
        <div
          v-if="actionWord == 'Delete'"
          class="p-4 md:p-5 space-y-4"
        >
          <p class="text-sm leading-relaxed text-[#667085] dark:text-gray-400">
            By <span v-if="actionWord == 'Deactivate'">Deactivating</span>
            <span v-if="actionWord == 'Delete'">deleting</span> this employee, they will
            be immediately removed from all current and future payroll cycles
          </p>
          <div>
            <label
              for="message"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Reason</label
            >
            <textarea
              id="message"
              v-model="reasonForAction"
              rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="What is the reason for this action"
            ></textarea>
          </div>
        </div>
        <div v-if="actionWord == 'Deactivate'" class="px-4 py-2 md:px-5 py-2 space-y-4">
          <p class="flex text-sm text-[#475467] dark:text-gray-400">
            Deactivating this team member will revoke their access to assigned platform
            features and capabilities.
          </p>
        </div>
        <div
          class="flex flex-row-reverse gap-2 p-4 md:p-5 rounded-b dark:border-gray-600"
        >
          <button
            v-if="actionWord == 'Activate'"
            @click.prevent="handleActivate"
            data-modal-hide="activate-deactivate-modal"
            type="button"
            class="text-[#FFFFFF] bg-[#00ace2] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            :disabled="isLoading"
          >
            Activate team member
          </button>
          <button
            v-if="actionWord == 'Deactivate'"
            @click.prevent="handleDeactivate"
            data-modal-hide="activate-deactivate-modal"
            type="button"
            class="text-[#FFFFFF] bg-[#D92D20] focus:ring-2 focus:outline-none focus:ring-b[#D92D20] font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-[#D92D20] dark:hover:bg-[#D92D20] dark:focus:ring-[#D92D20]"
            :disabled="isLoading"
          >
            Deactivate team member
          </button>
          <button
            @click="deleteEmployee"
            v-if="actionWord == 'Delete'"
            type="button"
            class="text-[#FFFFFF] bg-[#D92D20] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            :disabled="isLoading || reasonForAction == 0"
          >
            {{ actionWord }} employee
          </button>
          <button
          id="closeButton"
            @click="props.modal.hide()"
            type="button"
            class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-full border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import InputField from "@/components/InputField.vue";
import BaseDrawer from "@/components/BaseDrawer.vue";
import AccordionItem from "@/components/AccordionItem.vue";
import StatusBadge from "@/components/statusBadge/index.vue";
import SvgIcons from "@/components/SvgIcons.vue";
import { ref, onMounted, computed, watch } from "vue";
import api from "@/api";
const drawerId = "edit-role-drawer-right";
const drawerLabelId = "drawer-right-label";
import { useRoles } from "@/composables/useRoles";
const { role, updateRole, isLoading } = useRoles();

const props = defineProps(["role","editRole"]);

const roleDetails = ref(props.role);
const isEditRole = ref(props.editRole);

watch(() => {
  roleDetails.value = props.role;
});

// Create a reactive form
const form = ref({
  role_name: "",
  role_description: "",
  permissions: [],
});

const roleId = ref("");
let roleStaus = "";
const roleMembers = ref([]);

// Watch for changes in reactiveNewRole and update the form
watch(roleDetails, (role) => {
  roleId.value = role.id;
  roleMembers.value = role.members;
  roleStaus = role.status;
  form.value.role_name = role.name || "";
  form.value.role_description = role.description || "";
  form.value.permissions = role.permissions
    ? role.permissions.map((permission) => permission.id)
    : [];
});

const permissionsData = ref([]);

const isFormInvalid = computed(() => {
  return (
    form.role_name === "" || form.role_description === "" || form.permissions?.length < 1
  );
});
const handleEditRole = async () => {
  try {
    const roleData = {
      name: form.value.role_name,
      description: form.value.role_description,
      permissions: form.value.permissions,
    };

    console.log(roleData);
    // Call the updateRole function from the useRoles composable
    await updateRole(roleId.value, roleData);
    setTimeout(() => {isLoading.value = false; window.location.reload();}, 2000);
    // window.location.reload();
  } catch (error) {
    // Handle any specific error handling if needed
  }
};

onMounted(async () => {
  const response = await api.get("/permissions");
  permissionsData.value = response.data;
});
</script>

<template>
  <BaseDrawer :drawer-id="drawerId" :drawer-label-id="drawerLabelId">
    <template #title> Edit role </template>
    <template #content>
      <div class="mb-6">
        <span class="text-base text-[#101828]">Basic information {{ role.name }}</span>
      </div>

      <form class="mb-6 max-h-[80vh] overflow-y-auto" @submit.prevent="handleEditRole">
        <InputField
          v-model="form.role_name"
          id="role_name"
          label="Role name"
          type="text"
          placeholder="Role name"
        />
        <InputField
          id="description"
          label="Description"
          type="text"
          placeholder="Enter description"
          v-model="form.role_description"
        />

        <div class="mb-2">
          <p class="text text-sm text-[#101828]">Status</p>
          <StatusBadge :status="roleStaus.toString()" />
        </div>

        <div>
          <div>
            <p class="text text-sm text-[#101828]">Permissions</p>
          </div>
          <div class="flex justify-between my-4">
            <div class="w-full" id="accordion-collapse" data-accordion="collapse">
              <template v-for="(permissions, module) in permissionsData" :key="module">
                <div class="my-4 p-3 bg-[#F9FAFB] rounded-md">
                  <AccordionItem v-if="permissions.length > 1">
                    <template #title>
                      {{ module }}
                    </template>
                    <template #icon>
                      <SvgIcons :icon="module" />
                    </template>
                    <template #permissionsCount>{{
                      permissions.length + " Permissions"
                    }}</template>
                    <template #checkboxes>
                      <ul v-for="permission in permissions" :key="permission.id">
                        <li class="w-full">
                          <div class="flex items-center ps-3">
                            <label
                              :for="permission.id"
                              class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-[#475467]"
                            >
                              {{ permission.description }}
                            </label>
                            <input
                              :value="permission.id"
                              :id="permission.id"
                              type="checkbox"
                              v-model="form.permissions"
                              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
                            />
                          </div>
                        </li>
                      </ul>
                    </template>
                  </AccordionItem>
                  <template v-else>
                    <div class="flex justify-between">
                      <div class="flex item-center">
                        <SvgIcons :icon="module" />
                        <p class="mx-2 text-sm text-[#101828] capitalize">{{ module }}</p>
                      </div>
                      <label class="relative inline-flex items-center cursor-pointer">
                        <input
                          type="checkbox"
                          :value="permissions[0].id"
                          v-model="form.permissions"
                          class="sr-only peer"
                        />
                        <div
                          class="w-11 h-6 bg-[#F2F4F7] rounded-full peer peer-focus:ring-[#00ace2] dark:peer-focus:ring-[#00ace2] dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#00ace2]"
                        ></div>
                      </label>
                    </div>
                  </template>
                </div>
              </template>
            </div>
          </div>
        </div>

        <div class="mb-2">
          <p class="text text-sm text-[#101828]">Members ({{ roleMembers.length }})</p>
          <ul>
            <li class="flex justify-between items-center my-4" v-for="member in roleMembers" :key="member.id">
              <div>
                <p class="text-[#101828]" v-if="member?.first_name && member?.last_name">{{ member?.first_name+" " +member?.last_name }}</p>
                <p class="text-[#667085]">{{ member.email }}</p>
              </div>
              <div>
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M13.4482 17.4987H6.54818C5.67568 17.4987 4.95068 16.8254 4.88568 15.9545L4.13818 5.83203H15.8332L15.1107 15.9504C15.0482 16.8229 14.3224 17.4987 13.4482 17.4987V17.4987Z"
                    stroke="#F04438"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10.0002 9.16797V14.168"
                    stroke="#F04438"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M3.3335 5.83464H16.6668"
                    stroke="#F04438"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M14.1668 5.83333L13.3227 3.58167C13.0785 2.93083 12.4568 2.5 11.7618 2.5H8.2385C7.5435 2.5 6.92183 2.93083 6.67766 3.58167L5.8335 5.83333"
                    stroke="#F04438"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M12.8585 9.16797L12.5002 14.168"
                    stroke="#F04438"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M7.1418 9.16797L7.50013 14.168"
                    stroke="#F04438"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
            </li>
          </ul>
        </div>

        <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
          <button
          type="button"
          data-drawer-hide="edit-role-drawer-right"
          aria-controls="edit-role-drawer-right"
            class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
          >
            Cancel
          </button>
          
          <button v-if="isEditRole!==true" :disabled="isFormInvalid || isLoading" @click.prevent="isEditRole=true" class="btn btn-primary">
            {{ isLoading ? "Editing permissions..." : "Edit permissions" }}
          </button>
          <button v-else :disabled="isFormInvalid || isLoading" class="btn btn-primary">
            {{ isLoading ? "Saving changes..." : "Save changes" }}
          </button>
        </div>
      </form>
    </template>
  </BaseDrawer>
</template>

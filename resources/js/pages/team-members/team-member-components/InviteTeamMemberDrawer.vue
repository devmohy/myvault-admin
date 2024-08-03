<script setup>
import InputField from "@/components/InputField.vue";
import SelectField from "@/components/SelectField.vue";
import BaseDrawer from "@/components/BaseDrawer.vue";
import AccordionItem from "@/components/AccordionItem.vue";
import SvgIcons from "@/components/SvgIcons.vue";
import { ref, onMounted, reactive, computed, watch } from "vue";
import api from "@/api";
const drawerId = "invite-team-member-drawer-right";
const drawerLabelId = "drawer-right-label";
import { useRoles } from "@/composables/useRoles";
import { useTeamMembers } from "@/composables/useTeamMembers";
import { initFlowbite, initDrawers, Drawer } from "flowbite";
const { roles, role, fetchRole, fetchRoles, isLoading } = useRoles();
const { createTeamMember } = useTeamMembers();

// onMounted(() => {
//   const drawerElement = document.getElementById(drawerId);
//   if (drawerElement) {
//     // Assuming Flowbite is used for drawer functionality
//     const drawer = new Drawer(drawerElement);
//     drawer.init();
//     drawer.hide()
//   } else {
//     console.error("Drawer element not found.");
//   }
// });

const props = defineProps({
  open: Boolean
});

const permissionsData = ref([]);

const form = reactive({
  email: "",
  permissions: [], // Initialize as a ref
  roleId: "",
});
const isFormInvalid = computed(() => {
  return form.email === "" || form.roleId === "";
});
const handleInviteMember = async () => {
  try {
    isLoading.value = true;
    const roleData = {
      email: form.email,
      role_id: form.roleId,
    };
    // Call the createTeamMember function from the useTeamMembers composable
    await createTeamMember(roleData);

    // Clear the form or perform any other post-creation logic
    form.email = "";
    form.roleId = "";
    setTimeout(() => {
      isLoading.value = false;
      window.location.reload();
    }, 2000);
  } catch (error) {
    // Handle any specific error handling if needed
  } finally {
    isLoading.value = true;
  }
};

const handleRoleChange = async (roleId) => {
  try {
    const response = await fetchRole(roleId);
    form.permissions = response.permissions
      ? response.permissions.map((permission) => permission.id)
      : [];
    form.roleId = response.id;
    console.log(response.permissions.map);
  } catch (error) {
    // Handle any errors that may occur during the role change.
    console.error("Error fetching role data:", error);
  }
};

const resetForm = async () => {
  form.email = "";
  form.roleId = "";
  form.permissions = [];
};

const emit = defineEmits(['update:open']);
const updateOpen = (value) => {
  emit('update:open', value);
};

onMounted(async () => {
  // initFlowbite();
  const response = await api.get("/permissions");
  permissionsData.value = response.data;
  await fetchRoles(1000);
});
</script>

<template>
  <a-drawer
    :open="open"
    class="custom-class"
    root-class-name="root-class-name"
    :root-style="{ color: 'blue' }"
    style="color: red"
    @update:open="updateOpen"
    title="Invite team member"
    placement="right">
      <form
        class="mb-6 max-h-[80vh] overflow-y-auto"
        @submit.prevent="handleInviteMember"
      >
        <InputField
          v-model="form.email"
          id="member_email"
          label="Email address"
          type="email"
          placeholder="Enter email address"
        />
        <SelectField
          id="description"
          label="Role"
          placeholder="Select role"
          v-model="form.roleId"
          :options="roles"
          @change="handleRoleChange"
        />
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
                      <SvgIcons :icon="module == 'audit-trail' ? 'auditTrail' : module" />
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
                              disabled
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
                        <SvgIcons :icon="module == 'audit-trail' ? 'auditTrail' : module" />
                        <p class="mx-2 text-sm text-[#101828] capitalize">{{ module }}</p>
                      </div>
                      <label class="relative inline-flex items-center cursor-pointer">
                        <input
                          type="checkbox"
                          :value="permissions[0].id"
                          v-model="form.permissions"
                          disabled
                          class="sr-only peer"
                        />
                        <div
                          class="w-11 h-6 bg-[#F2F4F7] rounded-full peer peer-focus:ring-[#00ace2] dark:peer-focus:ring-[#00ace2] dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-200"
                        ></div>
                      </label>
                    </div>
                  </template>
                </div>
              </template>
            </div>
          </div>
        </div>

        <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
          <button
            :data-drawer-hide="drawerId"
            :aria-controls="drawerId"
            @click="resetForm"
            type="button"
            class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
          >
            Cancel
          </button>
          
          <button :disabled="isFormInvalid || isLoading" class="btn btn-primary">
            {{ isLoading ? "Inviting team member..." : "Invite team member" }}
          </button>
        </div>
      </form>
  </a-drawer>
</template>

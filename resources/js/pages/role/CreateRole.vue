<script setup>
import InputField from "@/components/InputField.vue";
import BaseDrawer from "@/components/BaseDrawer.vue";
import AccordionItem from "@/components/AccordionItem.vue";
import SvgIcons from "@/components/SvgIcons.vue";
import { ref, onMounted, reactive, computed } from "vue";
import api from "@/api";
const drawerId = "create-role-drawer-right";
const drawerLabelId = "drawer-right-label";
import { useRoles } from '@/composables/useRoles';
import { initFlowbite } from "flowbite";
const { createRole, isLoading } = useRoles();

const permissionsData = ref([]);

const form = reactive({
  role_name: "",
  role_description: "",
  permissions: [],
});
const isFormInvalid = computed(() => {
  return form.role_name === "" || form.role_description === "" || form.permissions.length < 1;
});
const handleCreateRole = async () => {
  try {
    const roleData = {
      name: form.role_name,
      description: form.role_description,
      permissions: form.permissions,
    };
    // Call the createRole function from the useRoles composable
    await createRole(roleData);

    // Clear the form or perform any other post-creation logic
    form.role_name = '';
    form.role_description = '';
    form.permissions = [];
    setTimeout(() => {isLoading.value = false; window.location.reload();}, 2000);
  }  catch (error) {
    if (error.response) {
      // Server returned an error response
      const { data } = error.response;
      if (data.message) {
        toast.error(data.message);
        return;
      }
    }
  } finally {
    isLoading.value = false;
  }
};
const selectedPermissions = reactive({});
const selectAllPermissions = (module) => {
  if (selectedPermissions[module]) {
    // If 'Select All' checkbox is checked, add all permissions to the form
    form.permissions.push(...permissionsData.value[module].map(permission => permission.id));
  } else {
    // If 'Select All' checkbox is unchecked, remove all permissions of the module from the form
    form.permissions = form.permissions.filter(permissionId => !permissionsData.value[module].map(permission => permission.id).includes(permissionId));
  }
};
onMounted(async () => {
  initFlowbite()
  const response = await api.get("/permissions");
  permissionsData.value = response.data;
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
    title="Create Role"
    placement="right">
      <div class="mb-6">
        <span class="text-base text-[#101828]">Basic information</span>
      </div>

      <form class="mb-6 max-h-[80vh] overflow-y-auto" @submit.prevent="handleCreateRole">
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
                    <template #permissionsCount>
                      <label class="relative inline-flex items-center cursor-pointer">
                        <input
                          type="checkbox"
                          v-model="selectedPermissions[module]"
                          class="sr-only peer"
                          @change="selectAllPermissions(module)"
                        />
                        <div
                          class="w-11 h-6 bg-[#F2F4F7] rounded-full peer peer-focus:ring-[#00ace2] dark:peer-focus:ring-[#00ace2] dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#00ace2]"
                        ></div>
                      </label>
                    </template>
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

        <div class="flex gap-2 absolute bottom-0 right-0 mr-2 mb-2">
          <button
          type="button"
          data-drawer-hide="create-role-drawer-right"
          aria-controls="create-role-drawer-right"
            class="text-sm text-[#344054] bg-[#ffffff] border hover:bg-gray-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-5 py-2.5 mb-2 dark:bg-gray-200 dark:hover:bg-gray-200 focus:outline-none dark:focus:ring-gray-200 block"
          >
            Cancel
          </button>
          <button :disabled="isFormInvalid || isLoading" class="btn btn-primary">
            {{ isLoading ? "Saving role..." : "Save role" }}
          </button>
        </div>
      </form>
      </a-drawer>
</template>

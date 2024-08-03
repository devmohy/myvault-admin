<script setup>
import InputField from "@/components/InputField.vue";
import Payslip from "@/components/payslip.vue";
import { useAuthStore } from "@/stores/auth";
import { useBusinesses } from "@/composables/useBusinesses";
import { ref, reactive, onBeforeMount, watch } from "vue";

const authStore = useAuthStore();
const { business, fetchBusiness, setNotification, savePayslipSettings } = useBusinesses();

const prefferedColor = ref("");
const smsEnabled = ref(authStore.user.business.enable_sms);
const emailEnabled = ref(authStore.user.business.enable_email);

// Initialize payslipSettings with default values or from business data if available
const payslipSettings = reactive({
  brand_color: business.value?.payslipSettings?.brand_color || "",
  company_logo: business.value?.payslipSettings?.company_logo || null,
  header_text: business.value?.payslipSettings?.header_text || "",
  footer_text: business.value?.payslipSettings?.footer_text || "",
});

// Function to update notification status
const updateStatus = (event) => {
  const isChecked = event.target.checked;
  const checkboxName = event.target.name;
  const data = { type: checkboxName, status: isChecked };
  setNotification(data);
};

// Function to handle file change in the file input
const handleFileChange = (event) => {
  payslipSettings.company_logo = event.target.files[0];
};

// Function to handle form submission
const handleSubmit = async () => {
  try {
    const formData = new FormData();
    formData.append("brand_color", payslipSettings.brand_color);
    formData.append("header_text", payslipSettings.header_text);
    formData.append("footer_text", payslipSettings.footer_text);
    formData.append("company_logo", payslipSettings.company_logo);
    
    await savePayslipSettings(formData);
    await fetchBusiness(authStore.user.business.id);
  } catch (error) {
    console.error("Error saving payslip settings:", error);
    // Handle error (e.g., show error message to user)
  }
};

onBeforeMount(async () => {
  await fetchBusiness(authStore.user.business.id);
});

watch(() => business.value, (newValue) => {
  // Update payslipSettings when business object changes
  payslipSettings.brand_color = newValue?.payslipSettings?.brand_color;
  payslipSettings.company_logo = newValue?.payslipSettings?.company_logo;
  payslipSettings.header_text = newValue?.payslipSettings?.header_text;
  payslipSettings.footer_text = newValue?.payslipSettings?.footer_text;
});
</script>
<template>
  <div
    class="hidden"
    id="system-configurations"
    role="tabpanel"
    aria-labelledby="system-configurations-tab"
  >
    <div
      class="border border-[#EAECF0] mb-4 p-4 rounded-lg bg-[#FFFFFF] dark:bg-[#FFFFFF]"
    >
      <div class="w-full">
        <p class="text text-base font-semibold text-[#101828]">Notifications</p>
        <div class="flex justify-between mt-6">
          <p class="text text-sm text-[#2B2E36] font-normal">Enable SMS notifications</p>
          <div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input
                type="checkbox"
                :checked="smsEnabled"
                name="sms"
                @change="updateStatus"
                class="sr-only peer"
              />
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#00ace2]"
              ></div>
            </label>
          </div>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text text-sm text-[#2B2E36] font-normal">
            Enable Email notifications
          </p>
          <div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input
                type="checkbox"
                :checked="emailEnabled"
                name="email"
                @change="updateStatus"
                class="sr-only peer"
              />
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#00ace2]"
              ></div>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div
      class="border border-[#EAECF0] mb-4 p-4 rounded-lg bg-[#FFFFFF] dark:bg-[#FFFFFF]"
    >
      <form @submit.prevent="handleSubmit">
        <div class="w-full">
          <p class="text text-base font-semibold text-[#101828]">Payslip setup</p>
          <div class="grid gap-x-10 md:grid-cols-2 mt-8">
            <div class="col-span-1">
              <div>
                <p class="flex text-xs gap-1 text-[#344054]">
                  Brand color
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_1920_52138)">
                      <path
                        d="M6.05998 5.9987C6.21672 5.55314 6.52608 5.17744 6.93328 4.93812C7.34048 4.6988 7.81924 4.61132 8.28476 4.69117C8.75028 4.77102 9.17252 5.01305 9.4767 5.37438C9.78087 5.73572 9.94735 6.19305 9.94665 6.66536C9.94665 7.9987 7.94665 8.66536 7.94665 8.66536M7.99998 11.332H8.00665M14.6666 7.9987C14.6666 11.6806 11.6819 14.6654 7.99998 14.6654C4.31808 14.6654 1.33331 11.6806 1.33331 7.9987C1.33331 4.3168 4.31808 1.33203 7.99998 1.33203C11.6819 1.33203 14.6666 4.3168 14.6666 7.9987Z"
                        stroke="#98A2B3"
                        stroke-width="1.33333"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_1920_52138">
                        <rect width="16" height="16" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </p>
                <div class="relative">
                  <input
                    type="text"
                    :value="payslipSettings.brand_color"
                    id="default-search"
                    style="padding-right: 50px;"
                    class="w-full item-center p-4 ps-12 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    required
                  />
                  <input
                    type="color"
                    v-model="payslipSettings.brand_color"
                    class="text-white absolute h-10 bg-transparent start-1 bottom-1 font-medium rounded-lg text-sm px-2.5 pt-2 pb-1"
                  />
                </div>
              </div>
              <div class="my-5">
                <label
                  class="block mb-1 text-xs font-medium text-[#344054] dark:text-white"
                  for="company_logo_file_input"
                  >Company logo</label
                >
                <input
                  ref="fileInput"
                  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                  aria-describedby="company_logo_input_help"
                  id="company_logo_file_input"
                  type="file"
                  @change="handleFileChange"
                />
                <p
                  class="mt-1 text-sm text-[#667085] dark:text-[#667085]"
                  id="company_logo_input_help"
                >
                  JPG, JPEG, PNG, PDF (max 2MB)
                </p>
              </div>
              <InputField
                id="header_text"
                label="Header text"
                placeholder="Enter the header text"
                type="text"
                v-model="payslipSettings.header_text"
              />
              <InputField
                id="footer_text"
                label="Footer text"
                placeholder="Enter the footer text"
                type="text"
                v-model="payslipSettings.footer_text"
              />
            </div>
            <div class="col-span-1">
              <p class="text-sm text-[#344054] font-semibold">Preview</p>
                <Payslip :color="payslipSettings.brand_color" :header="payslipSettings.header_text" :footer="payslipSettings.footer_text"/>
            </div>
          </div>
          <div class="flex item-center justify-end">
            <button
              type="submit"
              class="text-[#FFFFFF] bg-[#00ace2] hover:bg-[#00ace2] focus:ring-4 focus:ring-[#00ace2] font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-[#F2F4F7] dark:hover:bg-[#F2F4F7] focus:outline-none dark:focus:ring-[#F2F4F7] block"
            >
              Save changes
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

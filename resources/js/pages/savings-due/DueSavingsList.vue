<script setup>
import { onMounted, ref } from "vue";
import SavingsListItem from "./SavingsListItem.vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";
const savings = ref({ data: [] });
const selectedFilter = ref("all");
const filters = [
  { value: "", label: "All" },
  { value: "today", label: "Today" },
  { value: "tomorrow", label: "Tomorrow" },
  { value: "month", label: "This Month" },
  { value: "year", label: "This Year" },
];
const getSavings = (page = 1) => {
  axios.get(`/api/savings?page=${page}&due_date=${
    selectedFilter.value
  }`).then((response) => {
    savings.value = response.data;
  });
};

onMounted(() => {
    getSavings();
});

const handleFilterChange = () => {
    getSavings();
};
</script>
<template lang="">
  <div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white ml-2 p-0 mb-0">Savings</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                    <div class="col-lg-12 col-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">  
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">All Savings</h3>
                        </div>
                        <div class="col">
                            <div class="d-flex">
                        <select
                            v-model="selectedFilter"
                            @change="handleFilterChange"
                            class="form-control form-control-sm"
                        >
                            <option v-for="filter in filters" :key="filter.value" :value="filter.value">
                            {{ filter.label }}
                            </option>
                        </select>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <table class="table table-hover align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Name of Customer</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Amount to Save</th>
                                    <th scope="col">Savings Balance</th>
                                    <th scope="col">Savings Interest</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Saving Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                               <SavingsListItem v-for="(saving, index) in savings.data" :key="saving.id" :saving=saving :index=index />
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <Bootstrap4Pagination 
                            :data="savings"
                            @pagination-change-page="getSavings"
                        />
        </div>
    </div>
    </div>
  </div>
</template>
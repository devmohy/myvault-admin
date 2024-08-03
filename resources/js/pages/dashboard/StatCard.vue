<script setup>
import { ref, onMounted, inject } from "vue";
import { useRouter } from "vue-router";

const props = defineProps({
  statType:String,
  userId:String,
  title: String,
  formatValue: Boolean,
});
const selectedFilter = ref("all");
const statValue = ref(0);
const formatMoney = (value) =>{
    return new Intl.NumberFormat("en-NG", {
    style: "currency",
    currency: "NGN",
  }).format(value);
}

const filters = [
  { value: "all", label: "All" },
  { value: "today", label: "Today" },
  { value: "month", label: "This Month" },
  { value: "year", label: "This Year" },
];

const getStatValue = () => {
  const apiEndpoint = `/api/dashboard/stats/${props.statType}?filter=${
    selectedFilter.value
  }&user_id=${props.userId}`;

  axios
    .get(apiEndpoint)
    .then((response) => {
      statValue.value = response.data;
    })
    .catch((error) => {
      console.error(error);
      if (error.response && error.response.status === 401) {
        router.push("/login");
      }
    });
};

const handleFilterChange = () => {
  getStatValue();
};

onMounted(() => {
  getStatValue();
});

</script>
<!-- StatCard.vue -->
<template>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card card-stats p-4 h-100">
      <div class="d-flex align-items-center">
        <h5 class="card-title text-uppercase text-muted mb-0 flex-grow-1">{{ props.title }}</h5>
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
      <div class="row mt-2">
        <div class="col">
          <span class="h2 font-weight-bold mb-0">{{formatValue ? formatMoney(statValue) :statValue }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

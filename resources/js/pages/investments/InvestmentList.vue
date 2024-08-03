<script setup>
import { onMounted, ref } from "vue";
import InvestmentListItem from "./InvestmentListItem.vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";
const investments = ref({ data: [] });

const getInvestments = (page = 1) => {
  axios.get(`/api/investments?page=${page}`).then((response) => {
    investments.value = response.data;
  });
};

onMounted(() => {
    getInvestments();
});
</script>
<template lang="">
  <div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white ml-2 p-0 mb-0">Investments</h6>
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
                            <h3 class="mb-0">All Investments</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <table class="table table-hover align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Property</th>
                                    <th scope="col">Property Location</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Slot Purchased</th>
                                    <th scope="col">Total Aount Invested</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                               <InvestmentListItem v-for="(investment, index) in investments.data" :key="investment.id" :investment=investment :index=index />
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <Bootstrap4Pagination 
                            :data="investments"
                            @pagination-change-page="getInvestments"
                        />
        </div>
    </div>
    </div>
  </div>
</template>